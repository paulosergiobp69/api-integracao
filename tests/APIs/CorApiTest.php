<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Cor;

class CorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cor()
    {
        $cor = factory(Cor::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cors', $cor
        );

        $this->assertApiResponse($cor);
    }

    /**
     * @test
     */
    public function test_read_cor()
    {
        $cor = factory(Cor::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/cors/'.$cor->id
        );

        $this->assertApiResponse($cor->toArray());
    }

    /**
     * @test
     */
    public function test_update_cor()
    {
        $cor = factory(Cor::class)->create();
        $editedCor = factory(Cor::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cors/'.$cor->id,
            $editedCor
        );

        $this->assertApiResponse($editedCor);
    }

    /**
     * @test
     */
    public function test_delete_cor()
    {
        $cor = factory(Cor::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cors/'.$cor->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cors/'.$cor->id
        );

        $this->response->assertStatus(404);
    }
}
