<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipNotaris extends Model
{
    use HasFactory;


    protected $table = 'arsip_notaris';
    protected $guarded = ['id'];
}
