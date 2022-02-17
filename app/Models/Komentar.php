<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{

    protected $table = "comments";

    protected $fillable = [
      'user_id','service_id','comment_id','komentar'
    ];

    public function Service(){
      return $this->belongsTo('App\Models\Layanan');
    }

    public function User(){
      return $this->belongsTo('App\Models\User');
    }

    public function child(){
      return $this->hasMany('App\Models\Komentar','comment_id');
    }


}
