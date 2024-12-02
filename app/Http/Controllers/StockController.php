<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class StockController extends Controller
{
    // Mostrar una lista de todos los stocks
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    // Mostrar el formulario para crear un nuevo stock
    public function create()
    {
        return view('stocks.create');
    }
    public function refreshPrices()
    {
        $apiKey = config('services.alpha_vantage.key');
        $stocks = Stock::all();

        foreach ($stocks as $stock) {
            $response = Http::get("https://www.alphavantage.co/query", [
                'function' => 'GLOBAL_QUOTE',
                'symbol' => $stock->name,
                'apikey' => $apiKey,
            ]);

            if ($response->ok() && isset($response['Global Quote']['05. price'])) {
                $price = $response['Global Quote']['05. price'];
                $stock->update(['price' => $price]);
            }
        }

        return redirect()->route('stock_and_user.index')->with('success', 'Prices updated succesfully.');
    }
    // Guardar un nuevo stock en la base de datos
    /*public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:stocks,name|max:255',
            'price' => 'required|numeric',
        ]);

        Stock::create($request->all());
        return redirect()->route('stocks.index')->with('success', 'Stock creado exitosamente.');
    }
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Llamada a la API de Alpha Vantage
        $apiKey = config('services.alpha_vantage.key');
        $symbol = $request->input('name');
        $response = Http::get("https://www.alphavantage.co/query", [
            'function' => 'GLOBAL_QUOTE',
            'symbol' => $symbol,
            'apikey' => $apiKey,
        ]);

        // Verificar la respuesta
        if ($response->ok() && isset($response['Global Quote']['05. price'])) {
            $price = $response['Global Quote']['05. price'];

            // Crear el stock si la respuesta es válida
            Stock::create([
                'name' => $symbol,
                'price' => $price,
            ]);

            return redirect()->route('stocks.index')->with('success', 'Stock created succesfully');
        }

        // Si la API falla o el símbolo no es válido
        return redirect()->back()->withErrors(['name' => 'There were not Stock with that name ot the API had an error.']);
    }
    // Mostrar un stock específico
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stocks.show', compact('stock'));
    }

    // Mostrar el formulario para editar un stock
    public function edit($name)
    {
        $stock = Stock::findOrFail($name); // Busca el stock por su nombre (clave primaria)
        return view('stocks.edit', compact('stock')); // Pasa la variable $stock a la vista
    }

    // Actualizar un stock en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->all());
        return redirect()->route('stocks.index')->with('success', 'Stock updated succesfully.');
    }

    // Eliminar un stock de la base de datos
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock deleted succesfully.');
    }
}
