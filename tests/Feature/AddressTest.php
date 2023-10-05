<?php

namespace Tests\Feature;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_salvar_pesquisar_endereco_banco_dados()
    {
        $dados = Address::factory()->count(10)->create();
        
       
        $response = $this->getJson('/api/addresses/');        
        $response
        ->assertStatus(200)   //Quantidade de itens
        ->assertJsonCount(10, 'data') // Verifique a estrutura dos dados retornados
        ->assertJsonStructure([
            'data' => [
                '*' => ['number', 'complement', 'zipcode_id', 'entity_id']
            ]
        ]);
    }       
}
//3