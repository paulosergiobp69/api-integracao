<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PurchaseHistIncomingInvoice;

class PurchaseHistIncomingInvoiceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/purchase_hist_incoming_invoices', $purchaseHistIncomingInvoice
        );

        $this->assertApiResponse($purchaseHistIncomingInvoice);
    }

    /**
     * @test
     */
    public function test_read_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/purchase_hist_incoming_invoices/'.$purchaseHistIncomingInvoice->id
        );

        $this->assertApiResponse($purchaseHistIncomingInvoice->toArray());
    }

    /**
     * @test
     */
    public function test_update_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->create();
        $editedPurchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/purchase_hist_incoming_invoices/'.$purchaseHistIncomingInvoice->id,
            $editedPurchaseHistIncomingInvoice
        );

        $this->assertApiResponse($editedPurchaseHistIncomingInvoice);
    }

    /**
     * @test
     */
    public function test_delete_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/purchase_hist_incoming_invoices/'.$purchaseHistIncomingInvoice->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/purchase_hist_incoming_invoices/'.$purchaseHistIncomingInvoice->id
        );

        $this->response->assertStatus(404);
    }
}
