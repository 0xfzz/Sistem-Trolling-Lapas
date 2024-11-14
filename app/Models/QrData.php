<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrData extends Model
{
    public $table = "qrdata";
    public $fillable = ['lokasi'];
}
