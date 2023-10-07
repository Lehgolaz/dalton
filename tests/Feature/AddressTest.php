<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Stores;
use App\Models\ZipCode;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    // Teste para verificar se é possível salvar e pesquisar endereços no banco de dados.
    public function test_salvar_pesquisar_endereco_banco_dados()
    {
        // Crie 10 registros de endereço no banco de dados usando a factory
        $dados = Address::factory()->count(10)->create();
        
        // Faça uma solicitação GET JSON para a rota '/api/addresses/' para listar endereços
        $response = $this->getJson('/api/addresses/');        

        // Verifique se a resposta tem o código de status 200 (OK)
        // e se a estrutura dos dados retornados está correta
        $response
        ->assertStatus(200)
        ->assertJsonCount(10, 'data') // Verifique a quantidade de itens
        ->assertJsonStructure([
            'data' => [
                '*' => ['number', 'complement', 'zipcode_id', 'entity_id']
            ]
        ]);
    }     

    // Teste para verificar se é possível criar um endereço com sucesso.
    public function test_criar_endereco_com_sucesso()
    {
        // Crie um novo endereço aleatório usando a factory e converta-o em um array
        $newData = Address::factory()->make()->toArray();
      
        // Faça uma solicitação POST JSON para a rota '/api/addresses' para criar o endereço
        $response = $this->postJson('/api/addresses', $newData);

        // Verifique se a resposta tem o código de status 201 (Created)
        // e se a estrutura dos dados retornados está correta
        $response->assertStatus(201)
        ->assertJsonStructure(
              ['number', 'complement', 'zipcode_id', 'entity_id']
           );
    }  

    // Teste para verificar se falha ao salvar um endereço vazio.
    public function test_falhar_salvar_endereco_vazio()
    {
        // Faça uma solicitação POST JSON para a rota '/api/addresses' com um array vazio
        $response = $this->postJson('/api/addresses', []);

        // Verifique se a resposta tem o código de status 422 (Unprocessable Entity)
        // e se a validação falha para o campo 'number'
        $response->assertStatus(422)
        ->assertJsonValidationErrors(
            ['number']
        );
    }

    // Teste para verificar se falha ao salvar um endereço duplicado.
    public function test_falhar_salvar_endereco_duplicado()
    {
        // Crie um endereço no banco de dados usando a factory
        $salvar = Address::factory()->create();

        // Crie um novo endereço usando a factory e configure seu número igual ao do endereço existente
        $novo = Address::factory()->make()->toArray();
        $novo['number'] = $salvar->number_format;

        // Faça uma solicitação POST JSON para a rota '/api/addresses' com o endereço duplicado
        $response = $this->postJson('/api/addresses', $novo);

        // Verifique se a resposta tem o código de status 422 (Unprocessable Entity)
        // e se a validação falha para o campo 'number'
        $response->assertStatus(422)
        ->assertJsonValidationErrors(
            ['number']
        );
    }
    public function test_pesquisar_id_endereco_falhar(){
        $response = $this->getJson('/api/addresses/999999');

        $response->assertStatus(404)
        ->assertjson(['error' => 'Endereço não encontrado.']);
    }
    public function test_deletar_com_suceso(){
        $bairro = Address::factory()->create();

        $response = $this->deleteJson('/api/addresses/'.$bairro->id);

        $response->assertStatus(200)->assertJson(['message' => 'Endereço deletado com sucesso.']);
    }
    public function test_deletar_com_falhar(){
        $response = $this->deleteJson('/api/addresses/99999');

        $response->assertStatus(404)->assertjson(['error' => 'Endereço não encontrado.']);
    }
    public function test_tentar_deletar_com_relacionamentos_e_falhar(){
        $stores = Stores::factory()->create();

        $response = $this->deleteJson('/api/addresses/'. $stores->address_id);

        $response->assertStatus(400)->assertjson(['error' => 'Este endereço possui orçamentos ou lojas associadas e não pode ser excluído.']);
    }
}
