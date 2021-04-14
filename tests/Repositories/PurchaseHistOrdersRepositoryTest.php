<?php namespace Tests\Repositories;

use App\Models\PurchaseHistOrders;
use App\Repositories\PurchaseHistOrdersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PurchaseHistOrdersRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PurchaseHistOrdersRepository
     */
    protected $purchaseHistOrdersRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->purchaseHistOrdersRepo = \App::make(PurchaseHistOrdersRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->make()->toArray();

        $createdPurchaseHistOrders = $this->purchaseHistOrdersRepo->create($purchaseHistOrders);

        $createdPurchaseHistOrders = $createdPurchaseHistOrders->toArray();
        $this->assertArrayHasKey('id', $createdPurchaseHistOrders);
        $this->assertNotNull($createdPurchaseHistOrders['id'], 'Created PurchaseHistOrders must have id specified');
        $this->assertNotNull(PurchaseHistOrders::find($createdPurchaseHistOrders['id']), 'PurchaseHistOrders with given id must be in DB');
        $this->assertModelData($purchaseHistOrders, $createdPurchaseHistOrders);
    }

    /**
     * @test read
     */
    public function test_read_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->create();

        $dbPurchaseHistOrders = $this->purchaseHistOrdersRepo->find($purchaseHistOrders->id);

        $dbPurchaseHistOrders = $dbPurchaseHistOrders->toArray();
        $this->assertModelData($purchaseHistOrders->toArray(), $dbPurchaseHistOrders);
    }

    /**
     * @test update
     */
    public function test_update_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->create();
        $fakePurchaseHistOrders = factory(PurchaseHistOrders::class)->make()->toArray();

        $updatedPurchaseHistOrders = $this->purchaseHistOrdersRepo->update($fakePurchaseHistOrders, $purchaseHistOrders->id);

        $this->assertModelData($fakePurchaseHistOrders, $updatedPurchaseHistOrders->toArray());
        $dbPurchaseHistOrders = $this->purchaseHistOrdersRepo->find($purchaseHistOrders->id);
        $this->assertModelData($fakePurchaseHistOrders, $dbPurchaseHistOrders->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_purchase_hist_orders()
    {
        $purchaseHistOrders = factory(PurchaseHistOrders::class)->create();

        $resp = $this->purchaseHistOrdersRepo->delete($purchaseHistOrders->id);

        $this->assertTrue($resp);
        $this->assertNull(PurchaseHistOrders::find($purchaseHistOrders->id), 'PurchaseHistOrders should not exist in DB');
    }
}
