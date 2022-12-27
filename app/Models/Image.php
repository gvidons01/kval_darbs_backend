<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'image',
      ];
  
    public $timestamps = false;

    protected $table = 'images';
}
