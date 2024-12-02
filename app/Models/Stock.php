<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'name'; // Definir el campo como clave primaria
    public $incrementing = false; // Indica que no es un entero auto-incremental
    protected $keyType = 'string';

    protected $fillable = ['name', 'price'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'stock_and_users', 'id_stock', 'id_user');
    }
}
