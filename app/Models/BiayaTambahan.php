<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaTambahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'biaya_tambahan';
}
