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
    protected $fillable = [
        'ws_user_email',
        'ws_user_password',
    ];

    public function getAuthPassword()
    {
        return $this->ws_user_password;
    } 

}
