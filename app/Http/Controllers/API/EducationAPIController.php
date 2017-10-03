<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEducationAPIRequest;
use App\Http\Requests\API\UpdateEducationAPIRequest;
use App\Models\Education;
use App\Repositories\EducationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EducationController
 * @package App\Http\Controllers\API
 */

class EducationAPIController extends InfyOmBaseController
{
    /** @var  EducationRepository */
    private $educationRepository;

    public function __construct(EducationRepository $educationRepo)
    {
        $this->educationRepository = $educationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/education",
     *      summary="Get a listing of the Education.",
     *      tags={"Education"},
     *      description="Get all Education",
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
     *                  @SWG\Items(ref="#/definitions/Education")
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
        $this->educationRepository->pushCriteria(new RequestCriteria($request));
        $this->educationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $education = $this->educationRepository->all();

        return $this->sendResponse($education->toArray(), 'Education retrieved successfully');
    }

    /**
     * @param CreateEducationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/education",
     *      summary="Store a newly created Education in storage",
     *      tags={"Education"},
     *      description="Store Education",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Education that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Education")
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
     *                  ref="#/definitions/Education"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEducationAPIRequest $request)
    {
        $input = $request->all();

        $education = $this->educationRepository->create($input);

        return $this->sendResponse($education->toArray(), 'Education saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/education/{id}",
     *      summary="Display the specified Education",
     *      tags={"Education"},
     *      description="Get Education",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Education",
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
     *                  ref="#/definitions/Education"
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
        /** @var Education $education */
        $education = $this->educationRepository->find($id);

        if (empty($education)) {
            return Response::json(ResponseUtil::makeError('Education not found'), 404);
        }

        return $this->sendResponse($education->toArray(), 'Education retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEducationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/education/{id}",
     *      summary="Update the specified Education in storage",
     *      tags={"Education"},
     *      description="Update Education",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Education",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Education that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Education")
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
     *                  ref="#/definitions/Education"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEducationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Education $education */
        $education = $this->educationRepository->find($id);

        if (empty($education)) {
            return Response::json(ResponseUtil::makeError('Education not found'), 404);
        }

        $education = $this->educationRepository->update($input, $id);

        return $this->sendResponse($education->toArray(), 'Education updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/education/{id}",
     *      summary="Remove the specified Education from storage",
     *      tags={"Education"},
     *      description="Delete Education",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Education",
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
        /** @var Education $education */
        $education = $this->educationRepository->find($id);

        if (empty($education)) {
            return Response::json(ResponseUtil::makeError('Education not found'), 404);
        }

        $education->delete();

        return $this->sendResponse($id, 'Education deleted successfully');
    }
}
