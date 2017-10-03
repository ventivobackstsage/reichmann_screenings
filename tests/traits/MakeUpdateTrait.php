<?php

use Faker\Factory as Faker;
use App\Models\Update;
use App\Repositories\UpdateRepository;

trait MakeUpdateTrait
{
    /**
     * Create fake instance of Update and save it in database
     *
     * @param array $updateFields
     * @return Update
     */
    public function makeUpdate($updateFields = [])
    {
        /** @var UpdateRepository $updateRepo */
        $updateRepo = App::make(UpdateRepository::class);
        $theme = $this->fakeUpdateData($updateFields);
        return $updateRepo->create($theme);
    }

    /**
     * Get fake instance of Update
     *
     * @param array $updateFields
     * @return Update
     */
    public function fakeUpdate($updateFields = [])
    {
        return new Update($this->fakeUpdateData($updateFields));
    }

    /**
     * Get fake data of Update
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUpdateData($updateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'order_id' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'Description' => $fake->word,
            'user_id' => $fake->word
        ], $updateFields);
    }
}
