<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time la false
    protected $fillable = ['product_name', 'category_id','brand_id','product_desc','product_price',
    'product_price_sale','product_quantity','product_image','product_status'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function comment(){
        return $this->hasMany('App\Comment');
    }

    public function category(){
        return $this->belongsTo('App\Models\CategoryProduct','category_id');
    }
}
