<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExperienceApiTest extends TestCase
{
    use MakeExperienceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateExperience()
    {
        $experience = $this->fakeExperienceData();
        $this->json('POST', '/api/v1/experiences', $experience);

        $this->assertApiResponse($experience);
    }

    /**
     * @test
     */
    public function testReadExperience()
    {
        $experience = $this->makeExperience();
        $this->json('GET', '/api/v1/experiences/'.$experience->id);

        $this->assertApiResponse($experience->toArray());
    }

    /**
     * @test
     */
    public function testUpdateExperience()
    {
        $experience = $this->makeExperience();
        $editedExperience = $this->fakeExperienceData();

        $this->json('PUT', '/api/v1/experiences/'.$experience->id, $editedExperience);

        $this->assertApiResponse($editedExperience);
    }

    /**
     * @test
     */
    public function testDeleteExperience()
    {
        $experience = $this->makeExperience();
        $this->json('DELETE', '/api/v1/experiences/'.$experience->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/experiences/'.$experience->id);

        $this->assertResponseStatus(404);
    }
}
