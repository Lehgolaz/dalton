<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'imail', 'phone', 'cnpj', 'number', 'complement', 'address_ip'];

     public function address(){
        return $this->belongsTo(Address::class, 'addres_id');
    }

    public function priceLists(){
        return $this->hasMany(PriceList::class);
    }
   
}
