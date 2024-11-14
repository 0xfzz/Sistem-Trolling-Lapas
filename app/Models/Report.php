<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $table = "report";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
