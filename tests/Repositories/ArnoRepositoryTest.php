<?php namespace Tests\Repositories;

use App\Models\Arno;
use App\Repositories\ArnoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ArnoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ArnoRepository
     */
    protected $arnoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->arnoRepo = \App::make(ArnoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_arno()
    {
        $arno = factory(Arno::class)->make()->toArray();

        $createdArno = $this->arnoRepo->create($arno);

        $createdArno = $createdArno->toArray();
        $this->assertArrayHasKey('id', $createdArno);
        $this->assertNotNull($createdArno['id'], 'Created Arno must have id specified');
        $this->assertNotNull(Arno::find($createdArno['id']), 'Arno with given id must be in DB');
        $this->assertModelData($arno, $createdArno);
    }

    /**
     * @test read
     */
    public function test_read_arno()
    {
        $arno = factory(Arno::class)->create();

        $dbArno = $this->arnoRepo->find($arno->id);

        $dbArno = $dbArno->toArray();
        $this->assertModelData($arno->toArray(), $dbArno);
    }

    /**
     * @test update
     */
    public function test_update_arno()
    {
        $arno = factory(Arno::class)->create();
        $fakeArno = factory(Arno::class)->make()->toArray();

        $updatedArno = $this->arnoRepo->update($fakeArno, $arno->id);

        $this->assertModelData($fakeArno, $updatedArno->toArray());
        $dbArno = $this->arnoRepo->find($arno->id);
        $this->assertModelData($fakeArno, $dbArno->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_arno()
    {
        $arno = factory(Arno::class)->create();

        $resp = $this->arnoRepo->delete($arno->id);

        $this->assertTrue($resp);
        $this->assertNull(Arno::find($arno->id), 'Arno should not exist in DB');
    }
}
