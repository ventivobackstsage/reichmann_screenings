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

class ResumeController extends InfyOmBaseController
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the Update.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('admin.resume.index');
    }

}
