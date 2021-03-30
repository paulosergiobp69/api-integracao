<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Telefone;

class TelefoneApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_telefone()
    {
        $telefone = factory(Telefone::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/telefones', $telefone
        );

        $this->assertApiResponse($telefone);
    }

    /**
     * @test
     */
    public function test_read_telefone()
    {
        $telefone = factory(Telefone::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/telefones/'.$telefone->id
        );

        $this->assertApiResponse($telefone->toArray());
    }

    /**
     * @test
     */
    public function test_update_telefone()
    {
        $telefone = factory(Telefone::class)->create();
        $editedTelefone = factory(Telefone::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/telefones/'.$telefone->id,
            $editedTelefone
        );

        $this->assertApiResponse($editedTelefone);
    }

    /**
     * @test
     */
    public function test_delete_telefone()
    {
        $telefone = factory(Telefone::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/telefones/'.$telefone->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/telefones/'.$telefone->id
        );

        $this->response->assertStatus(404);
    }
}
