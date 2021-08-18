<?php namespace Tests\Repositories;

use App\Models\ProductSuppliers;
use App\Repositories\ProductSuppliersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductSuppliersRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductSuppliersRepository
     */
    protected $productSuppliersRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productSuppliersRepo = \App::make(ProductSuppliersRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->make()->toArray();

        $createdProductSuppliers = $this->productSuppliersRepo->create($productSuppliers);

        $createdProductSuppliers = $createdProductSuppliers->toArray();
        $this->assertArrayHasKey('id', $createdProductSuppliers);
        $this->assertNotNull($createdProductSuppliers['id'], 'Created ProductSuppliers must have id specified');
        $this->assertNotNull(ProductSuppliers::find($createdProductSuppliers['id']), 'ProductSuppliers with given id must be in DB');
        $this->assertModelData($productSuppliers, $createdProductSuppliers);
    }

    /**
     * @test read
     */
    public function test_read_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->create();

        $dbProductSuppliers = $this->productSuppliersRepo->find($productSuppliers->id);

        $dbProductSuppliers = $dbProductSuppliers->toArray();
        $this->assertModelData($productSuppliers->toArray(), $dbProductSuppliers);
    }

    /**
     * @test update
     */
    public function test_update_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->create();
        $fakeProductSuppliers = ProductSuppliers::factory()->make()->toArray();

        $updatedProductSuppliers = $this->productSuppliersRepo->update($fakeProductSuppliers, $productSuppliers->id);

        $this->assertModelData($fakeProductSuppliers, $updatedProductSuppliers->toArray());
        $dbProductSuppliers = $this->productSuppliersRepo->find($productSuppliers->id);
        $this->assertModelData($fakeProductSuppliers, $dbProductSuppliers->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_suppliers()
    {
        $productSuppliers = ProductSuppliers::factory()->create();

        $resp = $this->productSuppliersRepo->delete($productSuppliers->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductSuppliers::find($productSuppliers->id), 'ProductSuppliers should not exist in DB');
    }
}
