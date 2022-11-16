<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
      'price',
      'description',
      'tr_type',
      'user_id',
      'group_id',
      'category_id',
      'subcat_id',
    ];

    protected $table = 'ads';
}
