<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MS_Company extends Model
{
    use HasFactory;
    protected $table = 'ms_company';
    protected $primaryKey = 'ms_company_id';

    protected $fillable = [
        'ms_company_name_en',
        'ms_company_name_ar',
        'ms_company_name_cn',
        'ms_company_created_by',
        'ms_company_created_date',
        'ms_company_updated_by',
        'ms_company_updated_date',
    ];
}
