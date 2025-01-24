<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketEngMOD extends Model
{
    use HasFactory;
    protected $fillable = [
        'AsingId',
        'subject',
        'email','sender',
        'company',
        'branch',
        'state',
        'opendate',
        'TUpdate',
        'Assinreddate',
        'description',
    ];
}
