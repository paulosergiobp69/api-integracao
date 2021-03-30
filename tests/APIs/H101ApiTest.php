<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\H101;

class H101ApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_h101()
    {
        $h101 = factory(H101::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/h101_s', $h101
        );

        $this->assertApiResponse($h101);
    }

    /**
     * @test
     */
    public function test_read_h101()
    {
        $h101 = factory(H101::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/h101_s/'.$h101->H101_Id
        );

        $this->assertApiResponse($h101->toArray());
    }

    /**
     * @test
     */
    public function test_update_h101()
    {
        $h101 = factory(H101::class)->create();
        $editedH101 = factory(H101::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/h101_s/'.$h101->H101_Id,
            $editedH101
        );

        $this->assertApiResponse($editedH101);
    }

    /**
     * @test
     */
    public function test_delete_h101()
    {
        $h101 = factory(H101::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/h101_s/'.$h101->H101_Id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/h101_s/'.$h101->H101_Id
        );

        $this->response->assertStatus(404);
    }
}
