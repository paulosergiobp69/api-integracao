<?php namespace Tests\Repositories;

use App\Models\H100;
use App\Repositories\H100Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class H100RepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var H100Repository
     */
    protected $h100Repo;

    public function setUp() : void
    {
        parent::setUp();
        $this->h100Repo = \App::make(H100Repository::class);
    }

    /**
     * @test create
     */
    public function test_create_h100()
    {
        $h100 = factory(H100::class)->make()->toArray();

        $createdH100 = $this->h100Repo->create($h100);

        $createdH100 = $createdH100->toArray();
        $this->assertArrayHasKey('id', $createdH100);
        $this->assertNotNull($createdH100['id'], 'Created H100 must have id specified');
        $this->assertNotNull(H100::find($createdH100['id']), 'H100 with given id must be in DB');
        $this->assertModelData($h100, $createdH100);
    }

    /**
     * @test read
     */
    public function test_read_h100()
    {
        $h100 = factory(H100::class)->create();

        $dbH100 = $this->h100Repo->find($h100->H100_Id);

        $dbH100 = $dbH100->toArray();
        $this->assertModelData($h100->toArray(), $dbH100);
    }

    /**
     * @test update
     */
    public function test_update_h100()
    {
        $h100 = factory(H100::class)->create();
        $fakeH100 = factory(H100::class)->make()->toArray();

        $updatedH100 = $this->h100Repo->update($fakeH100, $h100->H100_Id);

        $this->assertModelData($fakeH100, $updatedH100->toArray());
        $dbH100 = $this->h100Repo->find($h100->H100_Id);
        $this->assertModelData($fakeH100, $dbH100->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_h100()
    {
        $h100 = factory(H100::class)->create();

        $resp = $this->h100Repo->delete($h100->H100_Id);

        $this->assertTrue($resp);
        $this->assertNull(H100::find($h100->H100_Id), 'H100 should not exist in DB');
    }
}
