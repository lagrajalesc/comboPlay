<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAssets extends Model
{
    protected $table = "company_assets";

    protected $fillable = [
        'id',
        'serial_code',
        'trademark',
        'reference',
        'description',
        'empleoyee_id',
        'created_at',
        'updated_at'
    ];
}
