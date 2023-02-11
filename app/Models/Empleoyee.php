<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Empleoyee extends Model
{

    protected $table = "empleoyee";

    protected $fillable = [
        'id',
        'name',
        'document_type',
        'document_number',
        'position',
        'department',
        'created_at',
        'updated_at'
    ];
}
