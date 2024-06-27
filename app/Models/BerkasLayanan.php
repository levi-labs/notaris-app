<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasLayanan extends Model
{
    use HasFactory;
    protected $table = 'berkas_layanan';
    protected $guarded = ['id'];

    // public function download($filename)
    // {
    //     return '/storage/' . $filename;
    // }
}
