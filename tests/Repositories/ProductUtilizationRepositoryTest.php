<?php namespace Tests\Repositories;

use App\Models\ProductUtilization;
use App\Repositories\ProductUtilizationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductUtilizationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductUtilizationRepository
     */
    protected $productUtilizationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productUtilizationRepo = \App::make(ProductUtilizationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->make()->toArray();

        $createdProductUtilization = $this->productUtilizationRepo->create($productUtilization);

        $createdProductUtilization = $createdProductUtilization->toArray();
        $this->assertArrayHasKey('id', $createdProductUtilization);
        $this->assertNotNull($createdProductUtilization['id'], 'Created ProductUtilization must have id specified');
        $this->assertNotNull(ProductUtilization::find($createdProductUtilization['id']), 'ProductUtilization with given id must be in DB');
        $this->assertModelData($productUtilization, $createdProductUtilization);
    }

    /**
     * @test read
     */
    public function test_read_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->create();

        $dbProductUtilization = $this->productUtilizationRepo->find($productUtilization->id);

        $dbProductUtilization = $dbProductUtilization->toArray();
        $this->assertModelData($productUtilization->toArray(), $dbProductUtilization);
    }

    /**
     * @test update
     */
    public function test_update_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->create();
        $fakeProductUtilization = ProductUtilization::factory()->make()->toArray();

        $updatedProductUtilization = $this->productUtilizationRepo->update($fakeProductUtilization, $productUtilization->id);

        $this->assertModelData($fakeProductUtilization, $updatedProductUtilization->toArray());
        $dbProductUtilization = $this->productUtilizationRepo->find($productUtilization->id);
        $this->assertModelData($fakeProductUtilization, $dbProductUtilization->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_utilization()
    {
        $productUtilization = ProductUtilization::factory()->create();

        $resp = $this->productUtilizationRepo->delete($productUtilization->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductUtilization::find($productUtilization->id), 'ProductUtilization should not exist in DB');
    }
}
