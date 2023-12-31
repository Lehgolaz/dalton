<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $fallable=['price', 'isAvailable', 'store_id', 'produt_id'];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function budgetDetails(){
        return $this->hasMany(BudgetDetail::class);
    }
}
