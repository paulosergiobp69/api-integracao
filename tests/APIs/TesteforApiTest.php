<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Testefor;

class TesteforApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_testefor()
    {
        $testefor = factory(Testefor::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/testefors', $testefor
        );

        $this->assertApiResponse($testefor);
    }

    /**
     * @test
     */
    public function test_read_testefor()
    {
        $testefor = factory(Testefor::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/testefors/'.$testefor->id
        );

        $this->assertApiResponse($testefor->toArray());
    }

    /**
     * @test
     */
    public function test_update_testefor()
    {
        $testefor = factory(Testefor::class)->create();
        $editedTestefor = factory(Testefor::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/testefors/'.$testefor->id,
            $editedTestefor
        );

        $this->assertApiResponse($editedTestefor);
    }

    /**
     * @test
     */
    public function test_delete_testefor()
    {
        $testefor = factory(Testefor::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/testefors/'.$testefor->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/testefors/'.$testefor->id
        );

        $this->response->assertStatus(404);
    }
}
