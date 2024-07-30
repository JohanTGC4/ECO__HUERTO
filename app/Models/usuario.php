<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\blog;

class usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'usuario', 'email', 'password', 'fotoperfil',
    ];

    public $incrementing = true;
    protected $keyType = 'int';
      // Relación uno a muchos con Blog
      public function blog()
      {
          return $this->hasMany(blog::class, 'usuario_id_usuario', 'id_usuario');
      }
}
