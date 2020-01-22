<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;
    protected $table = 'tb_users';
    public $timestamps = false;
    protected $primaryKey = 'Admin_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Username', 'Email', 'Password', 's_IsAdmin', 's_ThemeName', 'Login_FirstTime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password','remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
      * 
     * @HP
     */
    public function findForPassport($username)
    {
        return $this->where('Username', $username)->first();
    }

    /**
     * @HP
     */
    public function getAuthPassword()
    {
        return $this->PasswordHash;
    }
    
    /*public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->PasswordHash);
    }*/

    
}
