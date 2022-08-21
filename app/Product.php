<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['stock'];

   public function getPrice()
   {
       $price = $this->price;

       return number_format($price, 2, ',',' ') . ' FCFA';
   }
   public function getPaye()
   {
       $total = $this->total;

       return number_format($total, 2, ',',' ') . ' Eur';
   }


   public function categories()
   {
       return $this->belongsToMany('App\Category');
   }
}
