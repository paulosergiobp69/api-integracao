<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductLine;

class ProductLineApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_line()
    {
        $productLine = ProductLine::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_lines', $productLine
        );

        $this->assertApiResponse($productLine);
    }

    /**
     * @test
     */
    public function test_read_product_line()
    {
        $productLine = ProductLine::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_lines/'.$productLine->id
        );

        $this->assertApiResponse($productLine->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_line()
    {
        $productLine = ProductLine::factory()->create();
        $editedProductLine = ProductLine::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_lines/'.$productLine->id,
            $editedProductLine
        );

        $this->assertApiResponse($editedProductLine);
    }

    /**
     * @test
     */
    public function test_delete_product_line()
    {
        $productLine = ProductLine::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_lines/'.$productLine->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_lines/'.$productLine->id
        );

        $this->response->assertStatus(404);
    }
}
