<?php namespace Tests\Repositories;

use App\Models\Filme;
use App\Repositories\FilmeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FilmeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FilmeRepository
     */
    protected $filmeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->filmeRepo = \App::make(FilmeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_filme()
    {
        $filme = factory(Filme::class)->make()->toArray();

        $createdFilme = $this->filmeRepo->create($filme);

        $createdFilme = $createdFilme->toArray();
        $this->assertArrayHasKey('id', $createdFilme);
        $this->assertNotNull($createdFilme['id'], 'Created Filme must have id specified');
        $this->assertNotNull(Filme::find($createdFilme['id']), 'Filme with given id must be in DB');
        $this->assertModelData($filme, $createdFilme);
    }

    /**
     * @test read
     */
    public function test_read_filme()
    {
        $filme = factory(Filme::class)->create();

        $dbFilme = $this->filmeRepo->find($filme->id);

        $dbFilme = $dbFilme->toArray();
        $this->assertModelData($filme->toArray(), $dbFilme);
    }

    /**
     * @test update
     */
    public function test_update_filme()
    {
        $filme = factory(Filme::class)->create();
        $fakeFilme = factory(Filme::class)->make()->toArray();

        $updatedFilme = $this->filmeRepo->update($fakeFilme, $filme->id);

        $this->assertModelData($fakeFilme, $updatedFilme->toArray());
        $dbFilme = $this->filmeRepo->find($filme->id);
        $this->assertModelData($fakeFilme, $dbFilme->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_filme()
    {
        $filme = factory(Filme::class)->create();

        $resp = $this->filmeRepo->delete($filme->id);

        $this->assertTrue($resp);
        $this->assertNull(Filme::find($filme->id), 'Filme should not exist in DB');
    }
}
