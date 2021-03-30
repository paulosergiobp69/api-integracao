<?php namespace Tests\Repositories;

use App\Models\H101;
use App\Repositories\H101Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class H101RepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var H101Repository
     */
    protected $h101Repo;

    public function setUp() : void
    {
        parent::setUp();
        $this->h101Repo = \App::make(H101Repository::class);
    }

    /**
     * @test create
     */
    public function test_create_h101()
    {
        $h101 = factory(H101::class)->make()->toArray();

        $createdH101 = $this->h101Repo->create($h101);

        $createdH101 = $createdH101->toArray();
        $this->assertArrayHasKey('id', $createdH101);
        $this->assertNotNull($createdH101['id'], 'Created H101 must have id specified');
        $this->assertNotNull(H101::find($createdH101['id']), 'H101 with given id must be in DB');
        $this->assertModelData($h101, $createdH101);
    }

    /**
     * @test read
     */
    public function test_read_h101()
    {
        $h101 = factory(H101::class)->create();

        $dbH101 = $this->h101Repo->find($h101->H101_Id);

        $dbH101 = $dbH101->toArray();
        $this->assertModelData($h101->toArray(), $dbH101);
    }

    /**
     * @test update
     */
    public function test_update_h101()
    {
        $h101 = factory(H101::class)->create();
        $fakeH101 = factory(H101::class)->make()->toArray();

        $updatedH101 = $this->h101Repo->update($fakeH101, $h101->H101_Id);

        $this->assertModelData($fakeH101, $updatedH101->toArray());
        $dbH101 = $this->h101Repo->find($h101->H101_Id);
        $this->assertModelData($fakeH101, $dbH101->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_h101()
    {
        $h101 = factory(H101::class)->create();

        $resp = $this->h101Repo->delete($h101->H101_Id);

        $this->assertTrue($resp);
        $this->assertNull(H101::find($h101->H101_Id), 'H101 should not exist in DB');
    }
}
