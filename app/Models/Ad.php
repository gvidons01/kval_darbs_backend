<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    private $fillable = [
      'price',
      'description',
      'tr_type'
    ];

    private $table = 'ads';
}
