<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\H100;

class H100ApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_h100()
    {
        $h100 = factory(H100::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/h100_s', $h100
        );

        $this->assertApiResponse($h100);
    }

    /**
     * @test
     */
    public function test_read_h100()
    {
        $h100 = factory(H100::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/h100_s/'.$h100->H100_Id
        );

        $this->assertApiResponse($h100->toArray());
    }

    /**
     * @test
     */
    public function test_update_h100()
    {
        $h100 = factory(H100::class)->create();
        $editedH100 = factory(H100::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/h100_s/'.$h100->H100_Id,
            $editedH100
        );

        $this->assertApiResponse($editedH100);
    }

    /**
     * @test
     */
    public function test_delete_h100()
    {
        $h100 = factory(H100::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/h100_s/'.$h100->H100_Id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/h100_s/'.$h100->H100_Id
        );

        $this->response->assertStatus(404);
    }
}
