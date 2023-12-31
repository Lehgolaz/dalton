<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'budget_date', 'experation_date', 'delivery_date', 'shipping_value', 'address_id', 'budget_type_id'];

    public function addresses(){
        return $this->belongsTo(Address::class, 'address_id');
    }
    public function budgetType(){
        return $this->belongsTo(BudgetType::class, 'budget_type_id');
    }
    public function budgetDetails(){
        return $this->hasMany(AddreBUdgetDetailss::class);
    }
}
