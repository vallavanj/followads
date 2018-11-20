<?php

namespace App;
use App\Internaluser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','name', 'email', 'default_location','default_language_id','profile_img_url','mobile_number','phone_verified','is_active','created_by','created_at','updated_by','updated_at'
    ];
	
	protected $primaryKey = 'user_id';
	
	 public function register() {
      return $this->hasOne(Internaluser::class);
    }

    public function getPasswordAttribute() {
		/* echo "fdsgsfa";exit; */
        return $this->register->getAttribute('password');
     }
	 
	  protected $appends = [
      'password'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /* protected $hidden = [
        'password', 'remember_token',
    ]; */
}
