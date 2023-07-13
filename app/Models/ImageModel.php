<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;

    protected $table = 'image'; 

    protected $fillable = [
        'image_path',
        'user_ip',
        'created_at',
        'updated_at',
    ];
}