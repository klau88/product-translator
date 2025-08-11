<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /** @use HasFactory<\Database\Factories\TranslationFactory> */
    use HasFactory;


    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['product_id', 'language', 'name', 'description'];
}
