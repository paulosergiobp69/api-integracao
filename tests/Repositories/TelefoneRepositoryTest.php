<?php namespace Tests\Repositories;

use App\Models\Telefone;
use App\Repositories\TelefoneRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TelefoneRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TelefoneRepository
     */
    protected $telefoneRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->telefoneRepo = \App::make(TelefoneRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_telefone()
    {
        $telefone = factory(Telefone::class)->make()->toArray();

        $createdTelefone = $this->telefoneRepo->create($telefone);

        $createdTelefone = $createdTelefone->toArray();
        $this->assertArrayHasKey('id', $createdTelefone);
        $this->assertNotNull($createdTelefone['id'], 'Created Telefone must have id specified');
        $this->assertNotNull(Telefone::find($createdTelefone['id']), 'Telefone with given id must be in DB');
        $this->assertModelData($telefone, $createdTelefone);
    }

    /**
     * @test read
     */
    public function test_read_telefone()
    {
        $telefone = factory(Telefone::class)->create();

        $dbTelefone = $this->telefoneRepo->find($telefone->id);

        $dbTelefone = $dbTelefone->toArray();
        $this->assertModelData($telefone->toArray(), $dbTelefone);
    }

    /**
     * @test update
     */
    public function test_update_telefone()
    {
        $telefone = factory(Telefone::class)->create();
        $fakeTelefone = factory(Telefone::class)->make()->toArray();

        $updatedTelefone = $this->telefoneRepo->update($fakeTelefone, $telefone->id);

        $this->assertModelData($fakeTelefone, $updatedTelefone->toArray());
        $dbTelefone = $this->telefoneRepo->find($telefone->id);
        $this->assertModelData($fakeTelefone, $dbTelefone->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_telefone()
    {
        $telefone = factory(Telefone::class)->create();

        $resp = $this->telefoneRepo->delete($telefone->id);

        $this->assertTrue($resp);
        $this->assertNull(Telefone::find($telefone->id), 'Telefone should not exist in DB');
    }
}
