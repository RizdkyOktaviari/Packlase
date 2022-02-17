<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'phoneNumber',
        'roles',
        'profile_photo_path',
        'email',
        'password',
        'google_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toArray()
    {
        $toArray = parent::toArray();
        $toArray['profile_photo_path'] = $this->picturePath;
        return $toArray;
    }

    public function komentar(){
      return $this->hasMany('App\Models\Komentar');
    }

    public function rating(){
      return $this->hasMany('App\Models\Rating');
    }

    public function transaction(){
      return $this->hasMany('App\Models\Transaction');
    }

    public function getPicturePathAttribute()
    {
        return Storage::url($this->attributes['profile_photo_path']);
    }

}
