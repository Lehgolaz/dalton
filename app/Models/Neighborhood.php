<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function zipcode()
    {
        return $this->hasMany(ZipCode::class);
    }
}
