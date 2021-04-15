<?php namespace Tests\Repositories;

use App\Models\PurchaseHistIncomingInvoice;
use App\Repositories\PurchaseHistIncomingInvoiceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PurchaseHistIncomingInvoiceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PurchaseHistIncomingInvoiceRepository
     */
    protected $purchaseHistIncomingInvoiceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->purchaseHistIncomingInvoiceRepo = \App::make(PurchaseHistIncomingInvoiceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->make()->toArray();

        $createdPurchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepo->create($purchaseHistIncomingInvoice);

        $createdPurchaseHistIncomingInvoice = $createdPurchaseHistIncomingInvoice->toArray();
        $this->assertArrayHasKey('id', $createdPurchaseHistIncomingInvoice);
        $this->assertNotNull($createdPurchaseHistIncomingInvoice['id'], 'Created PurchaseHistIncomingInvoice must have id specified');
        $this->assertNotNull(PurchaseHistIncomingInvoice::find($createdPurchaseHistIncomingInvoice['id']), 'PurchaseHistIncomingInvoice with given id must be in DB');
        $this->assertModelData($purchaseHistIncomingInvoice, $createdPurchaseHistIncomingInvoice);
    }

    /**
     * @test read
     */
    public function test_read_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->create();

        $dbPurchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepo->find($purchaseHistIncomingInvoice->id);

        $dbPurchaseHistIncomingInvoice = $dbPurchaseHistIncomingInvoice->toArray();
        $this->assertModelData($purchaseHistIncomingInvoice->toArray(), $dbPurchaseHistIncomingInvoice);
    }

    /**
     * @test update
     */
    public function test_update_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->create();
        $fakePurchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->make()->toArray();

        $updatedPurchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepo->update($fakePurchaseHistIncomingInvoice, $purchaseHistIncomingInvoice->id);

        $this->assertModelData($fakePurchaseHistIncomingInvoice, $updatedPurchaseHistIncomingInvoice->toArray());
        $dbPurchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepo->find($purchaseHistIncomingInvoice->id);
        $this->assertModelData($fakePurchaseHistIncomingInvoice, $dbPurchaseHistIncomingInvoice->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_purchase_hist_incoming_invoice()
    {
        $purchaseHistIncomingInvoice = factory(PurchaseHistIncomingInvoice::class)->create();

        $resp = $this->purchaseHistIncomingInvoiceRepo->delete($purchaseHistIncomingInvoice->id);

        $this->assertTrue($resp);
        $this->assertNull(PurchaseHistIncomingInvoice::find($purchaseHistIncomingInvoice->id), 'PurchaseHistIncomingInvoice should not exist in DB');
    }
}
