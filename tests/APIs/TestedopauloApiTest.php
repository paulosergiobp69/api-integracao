<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Testedopaulo;

class TestedopauloApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/testedopaulos', $testedopaulo
        );

        $this->assertApiResponse($testedopaulo);
    }

    /**
     * @test
     */
    public function test_read_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/testedopaulos/'.$testedopaulo->id
        );

        $this->assertApiResponse($testedopaulo->toArray());
    }

    /**
     * @test
     */
    public function test_update_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->create();
        $editedTestedopaulo = factory(Testedopaulo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/testedopaulos/'.$testedopaulo->id,
            $editedTestedopaulo
        );

        $this->assertApiResponse($editedTestedopaulo);
    }

    /**
     * @test
     */
    public function test_delete_testedopaulo()
    {
        $testedopaulo = factory(Testedopaulo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/testedopaulos/'.$testedopaulo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/testedopaulos/'.$testedopaulo->id
        );

        $this->response->assertStatus(404);
    }
}
