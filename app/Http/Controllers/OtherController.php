<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateOtherRequest;
use App\Http\Requests\UpdateOtherRequest;
use App\Repositories\OtherRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Other;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OtherController extends InfyOmBaseController
{
    /** @var  OtherRepository */
    private $otherRepository;

    public function __construct(OtherRepository $otherRepo)
    {
        $this->otherRepository = $otherRepo;
    }

    /**
     * Display a listing of the Other.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->otherRepository->pushCriteria(new RequestCriteria($request));


	    if(Sentinel::inRole('admin'))
		    $others = $this->otherRepository->all();
	    elseif (Sentinel::inRole('candidate')){
		    $others = Sentinel::getUser()->candidate->other;
	    }

        return view('admin.others.index')
            ->with('others', $others);
    }

    /**
     * Show the form for creating a new Other.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.others.create');
    }

    /**
     * Store a newly created Other in storage.
     *
     * @param CreateOtherRequest $request
     *
     * @return Response
     */
    public function store(CreateOtherRequest $request)
    {
        $input = $request->all();

        $other = $this->otherRepository->create($input);

        Flash::success('Other saved successfully.');

        return redirect(route('admin.others.index'));
    }

    /**
     * Display the specified Other.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $other = $this->otherRepository->findWithoutFail($id);

        if (empty($other)) {
            Flash::error('Other not found');

            return redirect(route('others.index'));
        }

        return view('admin.others.show')->with('other', $other);
    }

    /**
     * Show the form for editing the specified Other.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $other = $this->otherRepository->findWithoutFail($id);

        if (empty($other)) {
            Flash::error('Other not found');

            return redirect(route('others.index'));
        }

        return view('admin.others.edit')->with('other', $other);
    }

    /**
     * Update the specified Other in storage.
     *
     * @param  int              $id
     * @param UpdateOtherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOtherRequest $request)
    {
        $other = $this->otherRepository->findWithoutFail($id);

        

        if (empty($other)) {
            Flash::error('Other not found');

            return redirect(route('others.index'));
        }

        $other = $this->otherRepository->update($request->all(), $id);

        Flash::success('Other updated successfully.');

        return redirect(route('admin.others.index'));
    }

    /**
     * Remove the specified Other from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.others.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Other::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.others.index'))->with('success', Lang::get('message.success.delete'));

       }

}
