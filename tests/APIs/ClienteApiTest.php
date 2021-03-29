<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Cliente;

class ClienteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cliente()
    {
        $cliente = factory(Cliente::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/clientes', $cliente
        );

        $this->assertApiResponse($cliente);
    }

    /**
     * @test
     */
    public function test_read_cliente()
    {
        $cliente = factory(Cliente::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/clientes/'.$cliente->id
        );

        $this->assertApiResponse($cliente->toArray());
    }

    /**
     * @test
     */
    public function test_update_cliente()
    {
        $cliente = factory(Cliente::class)->create();
        $editedCliente = factory(Cliente::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/clientes/'.$cliente->id,
            $editedCliente
        );

        $this->assertApiResponse($editedCliente);
    }

    /**
     * @test
     */
    public function test_delete_cliente()
    {
        $cliente = factory(Cliente::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/clientes/'.$cliente->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/clientes/'.$cliente->id
        );

        $this->response->assertStatus(404);
    }
}
