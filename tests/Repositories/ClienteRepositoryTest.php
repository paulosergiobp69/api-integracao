<?php namespace Tests\Repositories;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClienteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClienteRepository
     */
    protected $clienteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clienteRepo = \App::make(ClienteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cliente()
    {
        $cliente = factory(Cliente::class)->make()->toArray();

        $createdCliente = $this->clienteRepo->create($cliente);

        $createdCliente = $createdCliente->toArray();
        $this->assertArrayHasKey('id', $createdCliente);
        $this->assertNotNull($createdCliente['id'], 'Created Cliente must have id specified');
        $this->assertNotNull(Cliente::find($createdCliente['id']), 'Cliente with given id must be in DB');
        $this->assertModelData($cliente, $createdCliente);
    }

    /**
     * @test read
     */
    public function test_read_cliente()
    {
        $cliente = factory(Cliente::class)->create();

        $dbCliente = $this->clienteRepo->find($cliente->id);

        $dbCliente = $dbCliente->toArray();
        $this->assertModelData($cliente->toArray(), $dbCliente);
    }

    /**
     * @test update
     */
    public function test_update_cliente()
    {
        $cliente = factory(Cliente::class)->create();
        $fakeCliente = factory(Cliente::class)->make()->toArray();

        $updatedCliente = $this->clienteRepo->update($fakeCliente, $cliente->id);

        $this->assertModelData($fakeCliente, $updatedCliente->toArray());
        $dbCliente = $this->clienteRepo->find($cliente->id);
        $this->assertModelData($fakeCliente, $dbCliente->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cliente()
    {
        $cliente = factory(Cliente::class)->create();

        $resp = $this->clienteRepo->delete($cliente->id);

        $this->assertTrue($resp);
        $this->assertNull(Cliente::find($cliente->id), 'Cliente should not exist in DB');
    }
}
