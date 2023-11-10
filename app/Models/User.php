<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection   = 'mysql_dms';
    protected $table        = 'tbl_users';

    protected $fillable = [
        'usercode',
        'emp_idno',
        'username',
        'password',
        'default_password',
        'full_name',
        'mobile_no',
        'gender',
        'active',
        'access_rights',
        'change_password',
        'change_date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'modified_at',
        'modified_by',
        'deactiated_at',
        'deactivated_by',
        'is_admin',
    ];


    protected $hidden = [
        'password',
    ];
   
}
