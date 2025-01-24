<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketAdminMOD extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'assigne',
        'sender',
        'company',
        'branch',
        'state',
        'dateCreated',
        'description',
    ];
}
