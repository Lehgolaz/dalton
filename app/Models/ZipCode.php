<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    protected $fallable = ['zip_code', 'place', 'city_id', 'neighbordhood_id'];
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function neighbordhood()
    {
        return $this->belongsTo(Neighbordhood::class, 'neighbordhood_id');
    }
    public function address()
    {
        return $this->hasMany(Address::class,);
    }
}
