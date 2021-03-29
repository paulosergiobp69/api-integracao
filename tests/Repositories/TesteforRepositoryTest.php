<?php namespace Tests\Repositories;

use App\Models\Testefor;
use App\Repositories\TesteforRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TesteforRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TesteforRepository
     */
    protected $testeforRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->testeforRepo = \App::make(TesteforRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_testefor()
    {
        $testefor = factory(Testefor::class)->make()->toArray();

        $createdTestefor = $this->testeforRepo->create($testefor);

        $createdTestefor = $createdTestefor->toArray();
        $this->assertArrayHasKey('id', $createdTestefor);
        $this->assertNotNull($createdTestefor['id'], 'Created Testefor must have id specified');
        $this->assertNotNull(Testefor::find($createdTestefor['id']), 'Testefor with given id must be in DB');
        $this->assertModelData($testefor, $createdTestefor);
    }

    /**
     * @test read
     */
    public function test_read_testefor()
    {
        $testefor = factory(Testefor::class)->create();

        $dbTestefor = $this->testeforRepo->find($testefor->id);

        $dbTestefor = $dbTestefor->toArray();
        $this->assertModelData($testefor->toArray(), $dbTestefor);
    }

    /**
     * @test update
     */
    public function test_update_testefor()
    {
        $testefor = factory(Testefor::class)->create();
        $fakeTestefor = factory(Testefor::class)->make()->toArray();

        $updatedTestefor = $this->testeforRepo->update($fakeTestefor, $testefor->id);

        $this->assertModelData($fakeTestefor, $updatedTestefor->toArray());
        $dbTestefor = $this->testeforRepo->find($testefor->id);
        $this->assertModelData($fakeTestefor, $dbTestefor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_testefor()
    {
        $testefor = factory(Testefor::class)->create();

        $resp = $this->testeforRepo->delete($testefor->id);

        $this->assertTrue($resp);
        $this->assertNull(Testefor::find($testefor->id), 'Testefor should not exist in DB');
    }
}
