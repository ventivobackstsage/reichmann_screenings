<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUpdateAPIRequest;
use App\Http\Requests\API\UpdateUpdateAPIRequest;
use App\Models\Update;
use App\Repositories\UpdateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UpdateController
 * @package App\Http\Controllers\API
 */

class UpdateAPIController extends InfyOmBaseController
{
    /** @var  UpdateRepository */
    private $updateRepository;

    public function __construct(UpdateRepository $updateRepo)
    {
        $this->updateRepository = $updateRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/updates",
     *      summary="Get a listing of the Updates.",
     *      tags={"Update"},
     *      description="Get all Updates",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Update")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->updateRepository->pushCriteria(new RequestCriteria($request));
        $this->updateRepository->pushCriteria(new LimitOffsetCriteria($request));
        $updates = $this->updateRepository->all();

        return $this->sendResponse($updates->toArray(), 'Updates retrieved successfully');
    }

    /**
     * @param CreateUpdateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/updates",
     *      summary="Store a newly created Update in storage",
     *      tags={"Update"},
     *      description="Store Update",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Update that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Update")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Update"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUpdateAPIRequest $request)
    {
        $input = $request->all();

        $updates = $this->updateRepository->create($input);

        return $this->sendResponse($updates->toArray(), 'Update saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/updates/{id}",
     *      summary="Display the specified Update",
     *      tags={"Update"},
     *      description="Get Update",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Update",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Update"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Update $update */
        $update = $this->updateRepository->find($id);

        if (empty($update)) {
            return Response::json(ResponseUtil::makeError('Update not found'), 404);
        }

        return $this->sendResponse($update->toArray(), 'Update retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUpdateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/updates/{id}",
     *      summary="Update the specified Update in storage",
     *      tags={"Update"},
     *      description="Update Update",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Update",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Update that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Update")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Update"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUpdateAPIRequest $request)
    {
        $input = $request->all();

        /** @var Update $update */
        $update = $this->updateRepository->find($id);

        if (empty($update)) {
            return Response::json(ResponseUtil::makeError('Update not found'), 404);
        }

        $update = $this->updateRepository->update($input, $id);

        return $this->sendResponse($update->toArray(), 'Update updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/updates/{id}",
     *      summary="Remove the specified Update from storage",
     *      tags={"Update"},
     *      description="Delete Update",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Update",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Update $update */
        $update = $this->updateRepository->find($id);

        if (empty($update)) {
            return Response::json(ResponseUtil::makeError('Update not found'), 404);
        }

        $update->delete();

        return $this->sendResponse($id, 'Update deleted successfully');
    }
}
