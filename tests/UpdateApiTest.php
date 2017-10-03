<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateApiTest extends TestCase
{
    use MakeUpdateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUpdate()
    {
        $update = $this->fakeUpdateData();
        $this->json('POST', '/api/v1/updates', $update);

        $this->assertApiResponse($update);
    }

    /**
     * @test
     */
    public function testReadUpdate()
    {
        $update = $this->makeUpdate();
        $this->json('GET', '/api/v1/updates/'.$update->id);

        $this->assertApiResponse($update->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUpdate()
    {
        $update = $this->makeUpdate();
        $editedUpdate = $this->fakeUpdateData();

        $this->json('PUT', '/api/v1/updates/'.$update->id, $editedUpdate);

        $this->assertApiResponse($editedUpdate);
    }

    /**
     * @test
     */
    public function testDeleteUpdate()
    {
        $update = $this->makeUpdate();
        $this->json('DELETE', '/api/v1/updates/'.$update->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/updates/'.$update->id);

        $this->assertResponseStatus(404);
    }
}
