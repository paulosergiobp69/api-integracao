<?php namespace Tests\Repositories;

use App\Models\Fornecedor;
use App\Repositories\FornecedorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FornecedorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FornecedorRepository
     */
    protected $fornecedorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->fornecedorRepo = \App::make(FornecedorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_fornecedor()
    {
        $fornecedor = factory(Fornecedor::class)->make()->toArray();

        $createdFornecedor = $this->fornecedorRepo->create($fornecedor);

        $createdFornecedor = $createdFornecedor->toArray();
        $this->assertArrayHasKey('id', $createdFornecedor);
        $this->assertNotNull($createdFornecedor['id'], 'Created Fornecedor must have id specified');
        $this->assertNotNull(Fornecedor::find($createdFornecedor['id']), 'Fornecedor with given id must be in DB');
        $this->assertModelData($fornecedor, $createdFornecedor);
    }

    /**
     * @test read
     */
    public function test_read_fornecedor()
    {
        $fornecedor = factory(Fornecedor::class)->create();

        $dbFornecedor = $this->fornecedorRepo->find($fornecedor->id);

        $dbFornecedor = $dbFornecedor->toArray();
        $this->assertModelData($fornecedor->toArray(), $dbFornecedor);
    }

    /**
     * @test update
     */
    public function test_update_fornecedor()
    {
        $fornecedor = factory(Fornecedor::class)->create();
        $fakeFornecedor = factory(Fornecedor::class)->make()->toArray();

        $updatedFornecedor = $this->fornecedorRepo->update($fakeFornecedor, $fornecedor->id);

        $this->assertModelData($fakeFornecedor, $updatedFornecedor->toArray());
        $dbFornecedor = $this->fornecedorRepo->find($fornecedor->id);
        $this->assertModelData($fakeFornecedor, $dbFornecedor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_fornecedor()
    {
        $fornecedor = factory(Fornecedor::class)->create();

        $resp = $this->fornecedorRepo->delete($fornecedor->id);

        $this->assertTrue($resp);
        $this->assertNull(Fornecedor::find($fornecedor->id), 'Fornecedor should not exist in DB');
    }
}
