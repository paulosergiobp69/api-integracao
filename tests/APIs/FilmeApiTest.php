<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Filme;

class FilmeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_filme()
    {
        $filme = factory(Filme::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/filmes', $filme
        );

        $this->assertApiResponse($filme);
    }

    /**
     * @test
     */
    public function test_read_filme()
    {
        $filme = factory(Filme::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/filmes/'.$filme->id
        );

        $this->assertApiResponse($filme->toArray());
    }

    /**
     * @test
     */
    public function test_update_filme()
    {
        $filme = factory(Filme::class)->create();
        $editedFilme = factory(Filme::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/filmes/'.$filme->id,
            $editedFilme
        );

        $this->assertApiResponse($editedFilme);
    }

    /**
     * @test
     */
    public function test_delete_filme()
    {
        $filme = factory(Filme::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/filmes/'.$filme->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/filmes/'.$filme->id
        );

        $this->response->assertStatus(404);
    }
}
