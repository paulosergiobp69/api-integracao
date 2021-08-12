<?php namespace Tests\Repositories;

use App\Models\ProductLine;
use App\Repositories\ProductLineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductLineRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductLineRepository
     */
    protected $productLineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productLineRepo = \App::make(ProductLineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_line()
    {
        $productLine = ProductLine::factory()->make()->toArray();

        $createdProductLine = $this->productLineRepo->create($productLine);

        $createdProductLine = $createdProductLine->toArray();
        $this->assertArrayHasKey('id', $createdProductLine);
        $this->assertNotNull($createdProductLine['id'], 'Created ProductLine must have id specified');
        $this->assertNotNull(ProductLine::find($createdProductLine['id']), 'ProductLine with given id must be in DB');
        $this->assertModelData($productLine, $createdProductLine);
    }

    /**
     * @test read
     */
    public function test_read_product_line()
    {
        $productLine = ProductLine::factory()->create();

        $dbProductLine = $this->productLineRepo->find($productLine->id);

        $dbProductLine = $dbProductLine->toArray();
        $this->assertModelData($productLine->toArray(), $dbProductLine);
    }

    /**
     * @test update
     */
    public function test_update_product_line()
    {
        $productLine = ProductLine::factory()->create();
        $fakeProductLine = ProductLine::factory()->make()->toArray();

        $updatedProductLine = $this->productLineRepo->update($fakeProductLine, $productLine->id);

        $this->assertModelData($fakeProductLine, $updatedProductLine->toArray());
        $dbProductLine = $this->productLineRepo->find($productLine->id);
        $this->assertModelData($fakeProductLine, $dbProductLine->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_line()
    {
        $productLine = ProductLine::factory()->create();

        $resp = $this->productLineRepo->delete($productLine->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductLine::find($productLine->id), 'ProductLine should not exist in DB');
    }
}
