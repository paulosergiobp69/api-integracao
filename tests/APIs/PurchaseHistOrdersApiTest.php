<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PurchaseHistOrders;

class PurchaseHistOrdersApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/purchase_hist_orders', $purchaseHistOrders
        );

        $this->assertApiResponse($purchaseHistOrders);
    }

    /**
     * @test
     */
    public function test_read_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/purchase_hist_orders/'.$purchaseHistOrders->id
        );

        $this->assertApiResponse($purchaseHistOrders->toArray());
    }

    /**
     * @test
     */
    public function test_update_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->create();
        $editedPurchaseHistOrders = factory(PurchaseHistOrders::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/purchase_hist_orders/'.$purchaseHistOrders->id,
            $editedPurchaseHistOrders
        );

        $this->assertApiResponse($editedPurchaseHistOrders);
    }

    /**
     * @test
     */
    public function test_delete_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/purchase_hist_orders/'.$purchaseHistOrders->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/purchase_hist_orders/'.$purchaseHistOrders->id
        );

        $this->response->assertStatus(404);
    }
}
