<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
  protected $table = "jenisservices";

  protected $fillable = [
    'jenis', 'slug', 'description','rate', 'picturePath'
  ];

  public function Layanan(){
    return $this->hasMany('App\Models\Layanan', 'id');
  }

  public function toArray()
  {
      $toArray = parent::toArray();
      $toArray['picturePath'] = $this->picturePath;
      return $toArray;
  }

  public function getPicturePathAttribute()
  {
      return config('app.url') . $this->attributes['picturePath'];
  }
}
