<?php

namespace App\Models;



use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
      $message="you re the best";

        return [
            'id'              => $this->id,
            'name'      => $this->name,
            'email'       => $this->email,
            'email_verified_at'           => $this->email_verified_at,
            'password'   => $this->password,
            'remember_token' => $this->remember_token,
            'postulant' => 'Youre the best',
            
        ];

    }
}