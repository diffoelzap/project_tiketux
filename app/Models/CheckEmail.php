<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckEmail extends Model
{
    use HasFactory;

    protected $table = 'check_email';

    protected $fillable = [
        'id',
        'email',
        'validation',
        'id_transaction',
        'created_at'
    ];

    public $timestamps = true;
}
