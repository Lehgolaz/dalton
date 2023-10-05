<?php

namespace Tests\Feature;

use App\Models\Neighborhood;
use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NeigborhoodTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_salvar_pesquisar_bairro_banco_dados()
    {
        //Preparar os dados ou parametros
        Neighborhood::factory()->count(10)->create();
        //Processar
        $response = $this->getJson('/api/neighborhoods');        
        $response
        ->assertStatus(200)   //Quantidade de itens
        ->assertJsonCount(10, 'data') // Verifique a estrutura dos dados retornados
        ->assertJsonStructure([
            'data' => [
                '*' => ['id','name','created_at','updated_at',]
            ]
        ]);
    }

    /**
     * Criar um registro com sucesso
     * @return void
     */
    public function test_criar_bairro_com_sucesso()
    {
        //Criar bairro
        $newData = Neighborhood::factory()->make()->toArray();
      
        $response = $this->postJson('/api/neighborhoods', $newData);

        $response->assertStatus(201)
        ->assertJsonStructure(
              ['id','name','created_at','updated_at',]
           );
    }

    public function test_falhar_salvar_bairro_vazio()
    {
        $response = $this->postJson('/api/neighborhoods', []);
        $response->assertStatus(422)
        ->assertJsonValidationErrors(
            ['name']
        );
    }

    public function test_falhar_salvar_bairro_duplicado()
    {
        $salvar = Neighborhood::factory()->create();
        $novo = Neighborhood::factory()->make()->toArray();
        $novo['name'] = $salvar->name;

        $response = $this->postJson('/api/neighborhoods', $novo);
        $response->assertStatus(422)
        ->assertJsonValidationErrors(
            ['name']
        );
    }
    public function test_pesquisar_id_inexistente_falhar(){
        $response = $this->getJson('/api/neighborhoods/999999');

        $response->assertStatus(404)
        ->assertjson(['error' =>'Bairro não encontrado.']);
    }

    public function test_deletar_com_suceso(){
        $bairro = Neighborhood::factory()->create();

        $response = $this->deleteJson('/api/neighborhoods/'.$bairro->id);

        $response->assertStatus(200)->assertJson(['message' => 'Bairro deletado com sucesso.']);
    }

    public function test_deletar_com_falhar(){
        $response = $this->deleteJson('/api/neighborhoods/99999');

        $response->assertStatus(404)->assertjson(['error' => 'Bairro não encontrado.']);
    }

    public function test_tentar_deletar_com_relacionamentos_e_falhar(){
        $zip = ZipCode::factory()->create();

        $response = $this->deleteJson('/api/neighborhoods/'. $zip->neighborhood_id);

        $response->assertStatus(400)->assertjson(['error' => 'Este bairro possui códigos postais associados e não pode ser excluído.']);
    }
}
//1