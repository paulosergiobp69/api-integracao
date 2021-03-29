<?php namespace Tests\Repositories;

use App\Models\Cor;
use App\Repositories\CorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CorRepository
     */
    protected $corRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->corRepo = \App::make(CorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cor()
    {
        $cor = factory(Cor::class)->make()->toArray();

        $createdCor = $this->corRepo->create($cor);

        $createdCor = $createdCor->toArray();
        $this->assertArrayHasKey('id', $createdCor);
        $this->assertNotNull($createdCor['id'], 'Created Cor must have id specified');
        $this->assertNotNull(Cor::find($createdCor['id']), 'Cor with given id must be in DB');
        $this->assertModelData($cor, $createdCor);
    }

    /**
     * @test read
     */
    public function test_read_cor()
    {
        $cor = factory(Cor::class)->create();

        $dbCor = $this->corRepo->find($cor->id);

        $dbCor = $dbCor->toArray();
        $this->assertModelData($cor->toArray(), $dbCor);
    }

    /**
     * @test update
     */
    public function test_update_cor()
    {
        $cor = factory(Cor::class)->create();
        $fakeCor = factory(Cor::class)->make()->toArray();

        $updatedCor = $this->corRepo->update($fakeCor, $cor->id);

        $this->assertModelData($fakeCor, $updatedCor->toArray());
        $dbCor = $this->corRepo->find($cor->id);
        $this->assertModelData($fakeCor, $dbCor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cor()
    {
        $cor = factory(Cor::class)->create();

        $resp = $this->corRepo->delete($cor->id);

        $this->assertTrue($resp);
        $this->assertNull(Cor::find($cor->id), 'Cor should not exist in DB');
    }
}
