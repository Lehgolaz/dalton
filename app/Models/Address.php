<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'complment', 'zipcode_id', 'entity_id'];

    public function zipcode(){
        return $this-> belongsTo(ZipCode::class);
    }
    public function entity(){
        return $this-> belongsTo(Entity::class, 'entity_id');
    }
    public function budgets()
    {
        return $this->hasMany(Budgets::class);
    }

    //$address->entity
    //$address->zipcode
}
