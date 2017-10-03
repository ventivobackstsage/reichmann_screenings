<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUpdateRequest;
use App\Http\Requests\UpdateUpdateRequest;
use App\Repositories\UpdateRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Update;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UpdateController extends InfyOmBaseController
{
    /** @var  UpdateRepository */
    private $updateRepository;

    public function __construct(UpdateRepository $updateRepo)
    {
        $this->updateRepository = $updateRepo;
    }

    /**
     * Display a listing of the Update.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->updateRepository->pushCriteria(new RequestCriteria($request));
        $updates = $this->updateRepository->all();
        return view('admin.updates.index')
            ->with('updates', $updates);
    }

    /**
     * Show the form for creating a new Update.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.updates.create');
    }

    /**
     * Store a newly created Update in storage.
     *
     * @param CreateUpdateRequest $request
     *
     * @return Response
     */
    public function store(CreateUpdateRequest $request)
    {
        $input = $request->all();

        $update = $this->updateRepository->create($input);

        Flash::success('Update saved successfully.');

        return redirect(route('admin.updates.index'));
    }

    /**
     * Display the specified Update.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $update = $this->updateRepository->findWithoutFail($id);

        if (empty($update)) {
            Flash::error('Update not found');

            return redirect(route('updates.index'));
        }

        return view('admin.updates.show')->with('update', $update);
    }

    /**
     * Show the form for editing the specified Update.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $update = $this->updateRepository->findWithoutFail($id);

        if (empty($update)) {
            Flash::error('Update not found');

            return redirect(route('updates.index'));
        }

        return view('admin.updates.edit')->with('update', $update);
    }

    /**
     * Update the specified Update in storage.
     *
     * @param  int              $id
     * @param UpdateUpdateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUpdateRequest $request)
    {
        $update = $this->updateRepository->findWithoutFail($id);

        

        if (empty($update)) {
            Flash::error('Update not found');

            return redirect(route('updates.index'));
        }

        $update = $this->updateRepository->update($request->all(), $id);

        Flash::success('Update updated successfully.');

        return redirect(route('admin.updates.index'));
    }

    /**
     * Remove the specified Update from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.updates.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Update::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.updates.index'))->with('success', Lang::get('message.success.delete'));

       }

}
