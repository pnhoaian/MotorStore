<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; //set time la false
    protected $fillable = ['admin_user','admin_password','admin_name','admin_phone'];
    protected $primaryKey = 'admin_id';

    protected $table = 'tbl_admin';

    public function roles(){
        return $this->belongsToMany('App\Models\Roles','id_roles');
    }
}
