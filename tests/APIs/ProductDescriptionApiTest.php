<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductDescription;

class ProductDescriptionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_description()
    {
        $productDescription = ProductDescription::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_descriptions', $productDescription
        );

        $this->assertApiResponse($productDescription);
    }

    /**
     * @test
     */
    public function test_read_product_description()
    {
        $productDescription = ProductDescription::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_descriptions/'.$productDescription->id
        );

        $this->assertApiResponse($productDescription->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_description()
    {
        $productDescription = ProductDescription::factory()->create();
        $editedProductDescription = ProductDescription::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_descriptions/'.$productDescription->id,
            $editedProductDescription
        );

        $this->assertApiResponse($editedProductDescription);
    }

    /**
     * @test
     */
    public function test_delete_product_description()
    {
        $productDescription = ProductDescription::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_descriptions/'.$productDescription->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_descriptions/'.$productDescription->id
        );

        $this->response->assertStatus(404);
    }
}
