<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    //  public function setPasswordAttribute($value){ 
    //      $this->attributes['password'] =  Hash::make($value); 
    //  } 
    //RELACION  UNO A MUCHOS
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
    public function recipes(){
        return $this->hasMany('App\Models\Recipe');
    }
    public function products(){
        return $this->hasMany('App\Models\Product');
    }
    public function menus(){
        return $this->hasMany('App\Models\Menu');
    }

    //Para Adminlte
    public function adminlte_image(){
        if (Auth::user()->profile_photo_path === null) {
            return Auth::user()->profile_photo_url;
        }
        else {
            return asset('storage/' . Auth::user()->profile_photo_path);
        }
    }
    public function adminlte_desc()
    {
        if ( Auth::user()->hasRole('Admin')) {
            return 'Admin';
        }
        elseif(Auth::user()->hasRole('Aprendiz')){
            return 'Aprendiz';
        }
        else{
            return 'no rol';
        }
}
    public function adminlte_profile_url(){
        return 'profile/username';
    }
}
