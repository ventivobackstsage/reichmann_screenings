<?php

use App\Models\Update;
use App\Repositories\UpdateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateRepositoryTest extends TestCase
{
    use MakeUpdateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UpdateRepository
     */
    protected $updateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->updateRepo = App::make(UpdateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUpdate()
    {
        $update = $this->fakeUpdateData();
        $createdUpdate = $this->updateRepo->create($update);
        $createdUpdate = $createdUpdate->toArray();
        $this->assertArrayHasKey('id', $createdUpdate);
        $this->assertNotNull($createdUpdate['id'], 'Created Update must have id specified');
        $this->assertNotNull(Update::find($createdUpdate['id']), 'Update with given id must be in DB');
        $this->assertModelData($update, $createdUpdate);
    }

    /**
     * @test read
     */
    public function testReadUpdate()
    {
        $update = $this->makeUpdate();
        $dbUpdate = $this->updateRepo->find($update->id);
        $dbUpdate = $dbUpdate->toArray();
        $this->assertModelData($update->toArray(), $dbUpdate);
    }

    /**
     * @test update
     */
    public function testUpdateUpdate()
    {
        $update = $this->makeUpdate();
        $fakeUpdate = $this->fakeUpdateData();
        $updatedUpdate = $this->updateRepo->update($fakeUpdate, $update->id);
        $this->assertModelData($fakeUpdate, $updatedUpdate->toArray());
        $dbUpdate = $this->updateRepo->find($update->id);
        $this->assertModelData($fakeUpdate, $dbUpdate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUpdate()
    {
        $update = $this->makeUpdate();
        $resp = $this->updateRepo->delete($update->id);
        $this->assertTrue($resp);
        $this->assertNull(Update::find($update->id), 'Update should not exist in DB');
    }
}
