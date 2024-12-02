<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'password', 'email'];
    protected $hidden = ['password', 'remember_token'];
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'stock_and_users', 'id_user', 'id_stock');
    }
}
