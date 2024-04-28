<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BigData extends Model
{
    use HasFactory;

    protected $table = 'big_data';

    protected $fillable = [
        'title',
        'body',
        'image',
        'country',
        'city',
        'address',
        'email',
        'test5',
        'test6',
        'test7',
        'test8',
        'test9',
        'test10',
        'test11',
        'test12',
        'test13',
    ];
}
