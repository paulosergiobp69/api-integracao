<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Arno;

class ArnoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_arno()
    {
        $arno = factory(Arno::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/arnos', $arno
        );

        $this->assertApiResponse($arno);
    }

    /**
     * @test
     */
    public function test_read_arno()
    {
        $arno = factory(Arno::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/arnos/'.$arno->id
        );

        $this->assertApiResponse($arno->toArray());
    }

    /**
     * @test
     */
    public function test_update_arno()
    {
        $arno = factory(Arno::class)->create();
        $editedArno = factory(Arno::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/arnos/'.$arno->id,
            $editedArno
        );

        $this->assertApiResponse($editedArno);
    }

    /**
     * @test
     */
    public function test_delete_arno()
    {
        $arno = factory(Arno::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/arnos/'.$arno->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/arnos/'.$arno->id
        );

        $this->response->assertStatus(404);
    }
}
