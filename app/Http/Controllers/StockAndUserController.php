<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\StockAndUser;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class StockAndUserController extends Controller
{
    public function index()
    {
        $userEmail = Auth::user()->name;
        $stocksrelateduser = StockAndUser::where('id_user', $userEmail)
        ->select('id_stock') // Seleccionar solo el nombre del stock (id_stock)
        ->get();
        $stocks = Stock::whereIn('name', $stocksrelateduser)->get();
        $relations = StockAndUser::with('stock', 'user')->get();
        return view('stock_and_user.index', compact('relations','stocks'));
    }

    public function create()
    {
        $stocks = Stock::all();
        return view('stock_and_user.create', compact('stocks'));
    }    

    public function store(Request $request)
    {
        
        $request->validate([
            'stock_id' => 'required|exists:stocks,name',  // Buscar por 'name' en Stock
            'user_id' => 'required|exists:users,email',   // Validar 'user_id' por 'email' en User
        ]);
    
        // Obtener el Stock por 'name' y User por 'email'
        $stock = Stock::where('name', $request->stock_id)->first();
        $user = User::where('email', $request->user_id)->first();

        StockAndUser::create([
            'id_stock' => $stock->name,   // Guardar el 'name' de Stock
            'id_user' => $user->name,    // Guardar el 'email' de User
        ]);
    
        return redirect()->route('stock_and_user.index')->with('success', 'Stock added succesfully.');
    }
          
    // Mostrar formulario para editar una relación
    public function edit(StockAndUser $stockAndUser)
    {
        $stocks = Stock::all();
        $users = User::all();
        return view('stock_and_user.edit', compact('stockAndUser', 'stocks', 'users'));
    }

    // Actualizar una relación existente
    public function update(Request $request, StockAndUser $stockAndUser)
    {
        $request->validate([
            'id_stock' => 'required|exists:stocks,name',
            'id_user' => 'required|exists:users,name',
        ]);
        $stockAndUser->update($request->all());
        return redirect()->route('stock_and_user.index')->with('success', 'Relation updated succesfully');
    }

    // Eliminar una relación
    public function destroy(StockAndUser $stockAndUser)
    {
        $stockAndUser->delete();
        return redirect()->route('stock_and_user.index')->with('success', 'Relation deleted.');
    }
    public function erase($stockName, $userEmail)
    {
        // Encontrar la relación en la tabla stock_and_users usando los dos parámetros
        $relation = StockAndUser::where('id_stock', $stockName)
                                ->where('id_user', $userEmail)
                                ->first();
    
        if ($relation) {
            $relation->delete();
            return redirect()->back()->with('success', 'Relation deleted correctly.');
        }
    
        return redirect()->back()->with('error', 'Relation not found.');
    }
    
}
