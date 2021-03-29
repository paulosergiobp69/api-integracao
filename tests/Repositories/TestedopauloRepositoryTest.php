<?php namespace Tests\Repositories;

use App\Models\Testedopaulo;
use App\Repositories\TestedopauloRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TestedopauloRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TestedopauloRepository
     */
    protected $testedopauloRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->testedopauloRepo = \App::make(TestedopauloRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->make()->toArray();

        $createdTestedopaulo = $this->testedopauloRepo->create($testedopaulo);

        $createdTestedopaulo = $createdTestedopaulo->toArray();
        $this->assertArrayHasKey('id', $createdTestedopaulo);
        $this->assertNotNull($createdTestedopaulo['id'], 'Created Testedopaulo must have id specified');
        $this->assertNotNull(Testedopaulo::find($createdTestedopaulo['id']), 'Testedopaulo with given id must be in DB');
        $this->assertModelData($testedopaulo, $createdTestedopaulo);
    }

    /**
     * @test read
     */
    public function test_read_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->create();

        $dbTestedopaulo = $this->testedopauloRepo->find($testedopaulo->id);

        $dbTestedopaulo = $dbTestedopaulo->toArray();
        $this->assertModelData($testedopaulo->toArray(), $dbTestedopaulo);
    }

    /**
     * @test update
     */
    public function test_update_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->create();
        $fakeTestedopaulo = factory(Testedopaulo::class)->make()->toArray();

        $updatedTestedopaulo = $this->testedopauloRepo->update($fakeTestedopaulo, $testedopaulo->id);

        $this->assertModelData($fakeTestedopaulo, $updatedTestedopaulo->toArray());
        $dbTestedopaulo = $this->testedopauloRepo->find($testedopaulo->id);
        $this->assertModelData($fakeTestedopaulo, $dbTestedopaulo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->create();

        $resp = $this->testedopauloRepo->delete($testedopaulo->id);

        $this->assertTrue($resp);
        $this->assertNull(Testedopaulo::find($testedopaulo->id), 'Testedopaulo should not exist in DB');
    }
}
