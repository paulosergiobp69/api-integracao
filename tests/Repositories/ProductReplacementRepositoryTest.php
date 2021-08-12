<?php namespace Tests\Repositories;

use App\Models\ProductReplacement;
use App\Repositories\ProductReplacementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductReplacementRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductReplacementRepository
     */
    protected $productReplacementRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productReplacementRepo = \App::make(ProductReplacementRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->make()->toArray();

        $createdProductReplacement = $this->productReplacementRepo->create($productReplacement);

        $createdProductReplacement = $createdProductReplacement->toArray();
        $this->assertArrayHasKey('id', $createdProductReplacement);
        $this->assertNotNull($createdProductReplacement['id'], 'Created ProductReplacement must have id specified');
        $this->assertNotNull(ProductReplacement::find($createdProductReplacement['id']), 'ProductReplacement with given id must be in DB');
        $this->assertModelData($productReplacement, $createdProductReplacement);
    }

    /**
     * @test read
     */
    public function test_read_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->create();

        $dbProductReplacement = $this->productReplacementRepo->find($productReplacement->id);

        $dbProductReplacement = $dbProductReplacement->toArray();
        $this->assertModelData($productReplacement->toArray(), $dbProductReplacement);
    }

    /**
     * @test update
     */
    public function test_update_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->create();
        $fakeProductReplacement = ProductReplacement::factory()->make()->toArray();

        $updatedProductReplacement = $this->productReplacementRepo->update($fakeProductReplacement, $productReplacement->id);

        $this->assertModelData($fakeProductReplacement, $updatedProductReplacement->toArray());
        $dbProductReplacement = $this->productReplacementRepo->find($productReplacement->id);
        $this->assertModelData($fakeProductReplacement, $dbProductReplacement->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_replacement()
    {
        $productReplacement = ProductReplacement::factory()->create();

        $resp = $this->productReplacementRepo->delete($productReplacement->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductReplacement::find($productReplacement->id), 'ProductReplacement should not exist in DB');
    }
}
