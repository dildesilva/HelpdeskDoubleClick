<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doneEnftiket extends Model
{
    use HasFactory;
    protected $fillable = [
        'tokenNo',
        'client',
        'subject',
        'State',
        'email',
        'engid',
        'TUpdate'
    ];
}
