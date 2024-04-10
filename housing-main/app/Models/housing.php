<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class housing extends Model
{
    use HasFactory;
    protected $table = 'housing';
    protected $fillable = ['city', 'adres', 'type'];
}
