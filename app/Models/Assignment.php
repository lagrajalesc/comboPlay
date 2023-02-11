<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = "assignment";

    protected $fillable = [
        'id',
        'company_assets_id',
        'empleoyee_id',
        'created_at',
        'updated_at'

    ];
}
