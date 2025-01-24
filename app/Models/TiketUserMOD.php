<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketUserMOD extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'company','sender',
        'branch',
        'email',
        'description',
        'Assigned'
    ];
}
