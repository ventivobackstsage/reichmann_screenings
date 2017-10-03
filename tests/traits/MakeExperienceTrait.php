<?php

use Faker\Factory as Faker;
use App\Models\Experience;
use App\Repositories\ExperienceRepository;

trait MakeExperienceTrait
{
    /**
     * Create fake instance of Experience and save it in database
     *
     * @param array $experienceFields
     * @return Experience
     */
    public function makeExperience($experienceFields = [])
    {
        /** @var ExperienceRepository $experienceRepo */
        $experienceRepo = App::make(ExperienceRepository::class);
        $theme = $this->fakeExperienceData($experienceFields);
        return $experienceRepo->create($theme);
    }

    /**
     * Get fake instance of Experience
     *
     * @param array $experienceFields
     * @return Experience
     */
    public function fakeExperience($experienceFields = [])
    {
        return new Experience($this->fakeExperienceData($experienceFields));
    }

    /**
     * Get fake data of Experience
     *
     * @param array $postFields
     * @return array
     */
    public function fakeExperienceData($experienceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'candidate_id' => $fake->randomDigitNotNull,
            'Company' => $fake->word,
            'Period' => $fake->word,
            'Position' => $fake->word
        ], $experienceFields);
    }
}
