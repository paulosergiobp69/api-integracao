<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductSuppliers;

class ProductSuppliersApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_suppliers', $productSuppliers
        );

        $this->assertApiResponse($productSuppliers);
    }

    /**
     * @test
     */
    public function test_read_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_suppliers/'.$productSuppliers->id
        );

        $this->assertApiResponse($productSuppliers->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->create();
        $editedProductSuppliers = ProductSuppliers::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_suppliers/'.$productSuppliers->id,
            $editedProductSuppliers
        );

        $this->assertApiResponse($editedProductSuppliers);
    }

    /**
     * @test
     */
    public function test_delete_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_suppliers/'.$productSuppliers->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_suppliers/'.$productSuppliers->id
        );

        $this->response->assertStatus(404);
    }
}
