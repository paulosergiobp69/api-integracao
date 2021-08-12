<?php namespace Tests\Repositories;

use App\Models\ProductGroup;
use App\Repositories\ProductGroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductGroupRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductGroupRepository
     */
    protected $productGroupRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productGroupRepo = \App::make(ProductGroupRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_group()
    {
        $productGroup = ProductGroup::factory()->make()->toArray();

        $createdProductGroup = $this->productGroupRepo->create($productGroup);

        $createdProductGroup = $createdProductGroup->toArray();
        $this->assertArrayHasKey('id', $createdProductGroup);
        $this->assertNotNull($createdProductGroup['id'], 'Created ProductGroup must have id specified');
        $this->assertNotNull(ProductGroup::find($createdProductGroup['id']), 'ProductGroup with given id must be in DB');
        $this->assertModelData($productGroup, $createdProductGroup);
    }

    /**
     * @test read
     */
    public function test_read_product_group()
    {
        $productGroup = ProductGroup::factory()->create();

        $dbProductGroup = $this->productGroupRepo->find($productGroup->id);

        $dbProductGroup = $dbProductGroup->toArray();
        $this->assertModelData($productGroup->toArray(), $dbProductGroup);
    }

    /**
     * @test update
     */
    public function test_update_product_group()
    {
        $productGroup = ProductGroup::factory()->create();
        $fakeProductGroup = ProductGroup::factory()->make()->toArray();

        $updatedProductGroup = $this->productGroupRepo->update($fakeProductGroup, $productGroup->id);

        $this->assertModelData($fakeProductGroup, $updatedProductGroup->toArray());
        $dbProductGroup = $this->productGroupRepo->find($productGroup->id);
        $this->assertModelData($fakeProductGroup, $dbProductGroup->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_group()
    {
        $productGroup = ProductGroup::factory()->create();

        $resp = $this->productGroupRepo->delete($productGroup->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductGroup::find($productGroup->id), 'ProductGroup should not exist in DB');
    }
}
