<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = "log_assignment";

    protected $fillable = [
        'id',
        'assigner',
        'payload',
        'assignment_id',
        'created_at'
    ];

}
