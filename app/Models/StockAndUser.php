<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAndUser extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no es el plural del nombre del modelo, es necesario especificarlo
    protected $table = 'stock_and_users'; // Verifica que el nombre de la tabla sea correcto

    // Especificamos las columnas que pueden ser asignadas masivamente
    protected $fillable = ['id_stock', 'id_user'];

    // Relación con el modelo Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
