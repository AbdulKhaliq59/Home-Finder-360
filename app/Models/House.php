<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'user_id',
        'house_name',
        'area',
        'price',
        'type',
        'rooms',
        'image_urls',
        'address',
        'additional_description'
    ];
    protected $casts = [
        'image_urls' => 'json',
        'address' => 'json',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
