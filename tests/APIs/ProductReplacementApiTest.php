<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductReplacement;

class ProductReplacementApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_replacements', $productReplacement
        );

        $this->assertApiResponse($productReplacement);
    }

    /**
     * @test
     */
    public function test_read_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_replacements/'.$productReplacement->id
        );

        $this->assertApiResponse($productReplacement->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->create();
        $editedProductReplacement = ProductReplacement::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_replacements/'.$productReplacement->id,
            $editedProductReplacement
        );

        $this->assertApiResponse($editedProductReplacement);
    }

    /**
     * @test
     */
    public function test_delete_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_replacements/'.$productReplacement->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_replacements/'.$productReplacement->id
        );

        $this->response->assertStatus(404);
    }
}
