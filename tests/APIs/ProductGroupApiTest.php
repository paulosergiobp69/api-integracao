<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductGroup;

class ProductGroupApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_group()
    {
        $productGroup = ProductGroup::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_groups', $productGroup
        );

        $this->assertApiResponse($productGroup);
    }

    /**
     * @test
     */
    public function test_read_product_group()
    {
        $productGroup = ProductGroup::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_groups/'.$productGroup->id
        );

        $this->assertApiResponse($productGroup->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_group()
    {
        $productGroup = ProductGroup::factory()->create();
        $editedProductGroup = ProductGroup::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_groups/'.$productGroup->id,
            $editedProductGroup
        );

        $this->assertApiResponse($editedProductGroup);
    }

    /**
     * @test
     */
    public function test_delete_product_group()
    {
        $productGroup = ProductGroup::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_groups/'.$productGroup->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_groups/'.$productGroup->id
        );

        $this->response->assertStatus(404);
    }
}
