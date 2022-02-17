<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";

    use HasFactory;

    protected $fillable = [
      'user_id','jenisservice_id','transaction_id','rate'
    ];

    public function Service(){
      return $this->belongsToMany('App\Models\Layanan');
    }

    public function User(){
      return $this->belongsTo('App\Models\User');
    }

    public function transaction()
    {
      return $this->belongsTo('App\Models\Transaction');
    }

}
