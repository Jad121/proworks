<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ws_user extends Authenticatable
{

    use HasFactory;

    protected $table= 'ws_user';
    protected $primaryKey = 'ws_user_id';
    public $timestamps = false; 
    protected $fillable = [
        'ws_country_id',
        'ws_user_first_name',
        'ws_user_last_name',
        'ws_user_email',
        'ws_user_password',
        'ws_user_phone',
        'ws_user_address',
        'ws_user_created_by',
        'ws_user_created_date',
        'ws_user_updated_by',
        'ws_user_updated_date',
    ];

    public function getAuthPassword()
    {
        return $this->ws_user_password;
    } 

}
