<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf_cnpj', 'rg_ie', 'imail', 'telefone'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function budgets()
    {
        return $this->hasMany(Budgets::class);
    }
}
