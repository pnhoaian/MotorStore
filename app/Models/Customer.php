<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false; //set time la false
    protected $fillable = ['customer_name', 'customer_email','customer_password','customer_phone','customer_address','customer_vip'];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';
}
