<?php namespace Tests\Repositories;

use App\Models\ProductDescription;
use App\Repositories\ProductDescriptionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductDescriptionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductDescriptionRepository
     */
    protected $productDescriptionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productDescriptionRepo = \App::make(ProductDescriptionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_description()
    {
        $productDescription = ProductDescription::factory()->make()->toArray();

        $createdProductDescription = $this->productDescriptionRepo->create($productDescription);

        $createdProductDescription = $createdProductDescription->toArray();
        $this->assertArrayHasKey('id', $createdProductDescription);
        $this->assertNotNull($createdProductDescription['id'], 'Created ProductDescription must have id specified');
        $this->assertNotNull(ProductDescription::find($createdProductDescription['id']), 'ProductDescription with given id must be in DB');
        $this->assertModelData($productDescription, $createdProductDescription);
    }

    /**
     * @test read
     */
    public function test_read_product_description()
    {
        $productDescription = ProductDescription::factory()->create();

        $dbProductDescription = $this->productDescriptionRepo->find($productDescription->id);

        $dbProductDescription = $dbProductDescription->toArray();
        $this->assertModelData($productDescription->toArray(), $dbProductDescription);
    }

    /**
     * @test update
     */
    public function test_update_product_description()
    {
        $productDescription = ProductDescription::factory()->create();
        $fakeProductDescription = ProductDescription::factory()->make()->toArray();

        $updatedProductDescription = $this->productDescriptionRepo->update($fakeProductDescription, $productDescription->id);

        $this->assertModelData($fakeProductDescription, $updatedProductDescription->toArray());
        $dbProductDescription = $this->productDescriptionRepo->find($productDescription->id);
        $this->assertModelData($fakeProductDescription, $dbProductDescription->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_description()
    {
        $productDescription = ProductDescription::factory()->create();

        $resp = $this->productDescriptionRepo->delete($productDescription->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductDescription::find($productDescription->id), 'ProductDescription should not exist in DB');
    }
}
