<?php

use App\Models\Experience;
use App\Repositories\ExperienceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExperienceRepositoryTest extends TestCase
{
    use MakeExperienceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExperienceRepository
     */
    protected $experienceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->experienceRepo = App::make(ExperienceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateExperience()
    {
        $experience = $this->fakeExperienceData();
        $createdExperience = $this->experienceRepo->create($experience);
        $createdExperience = $createdExperience->toArray();
        $this->assertArrayHasKey('id', $createdExperience);
        $this->assertNotNull($createdExperience['id'], 'Created Experience must have id specified');
        $this->assertNotNull(Experience::find($createdExperience['id']), 'Experience with given id must be in DB');
        $this->assertModelData($experience, $createdExperience);
    }

    /**
     * @test read
     */
    public function testReadExperience()
    {
        $experience = $this->makeExperience();
        $dbExperience = $this->experienceRepo->find($experience->id);
        $dbExperience = $dbExperience->toArray();
        $this->assertModelData($experience->toArray(), $dbExperience);
    }

    /**
     * @test update
     */
    public function testUpdateExperience()
    {
        $experience = $this->makeExperience();
        $fakeExperience = $this->fakeExperienceData();
        $updatedExperience = $this->experienceRepo->update($fakeExperience, $experience->id);
        $this->assertModelData($fakeExperience, $updatedExperience->toArray());
        $dbExperience = $this->experienceRepo->find($experience->id);
        $this->assertModelData($fakeExperience, $dbExperience->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteExperience()
    {
        $experience = $this->makeExperience();
        $resp = $this->experienceRepo->delete($experience->id);
        $this->assertTrue($resp);
        $this->assertNull(Experience::find($experience->id), 'Experience should not exist in DB');
    }
}
