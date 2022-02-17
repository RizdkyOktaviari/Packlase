<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicePhoto extends Model
{
  use HasFactory;

  protected $table = "service_photos";

  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'service_id','picturePath'
  ];

  public function service(){
    return $this->belongsTo('App\Models\Layanan', 'service_id', 'id');
  }
}
