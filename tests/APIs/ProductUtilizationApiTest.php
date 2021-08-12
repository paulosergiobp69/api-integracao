<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductUtilization;

class ProductUtilizationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_utilizations', $productUtilization
        );

        $this->assertApiResponse($productUtilization);
    }

    /**
     * @test
     */
    public function test_read_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_utilizations/'.$productUtilization->id
        );

        $this->assertApiResponse($productUtilization->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->create();
        $editedProductUtilization = ProductUtilization::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_utilizations/'.$productUtilization->id,
            $editedProductUtilization
        );

        $this->assertApiResponse($editedProductUtilization);
    }

    /**
     * @test
     */
    public function test_delete_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_utilizations/'.$productUtilization->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_utilizations/'.$productUtilization->id
        );

        $this->response->assertStatus(404);
    }
}
