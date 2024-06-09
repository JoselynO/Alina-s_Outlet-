<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 *
 * La clase User representa a los usuarios en la aplicacion. Extiende de Authenticatable para proporcionar funcionalidad de autenticacion.
 *
 * @package App\Models
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class User extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role'
    ];

    /**
     * Los atributos que deben estar ocultos para la serializacion.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Obtiene las direcciones asociadas al usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany La relacion de direcciones del usuario.
     */
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    /**
     * Obtiene las ordenes asociadas al usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany La relacion de ordenes del usuario.
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
