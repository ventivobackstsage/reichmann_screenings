<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUpdateRequest;
use App\Http\Requests\UpdateUpdateRequest;
use App\Repositories\OrderRepository;
use App\Repositories\UpdateRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Update;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ResumeController extends InfyOmBaseController
{

    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Update.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $id = Sentinel::getUser()->candidate->orders->id;

        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('admin.dashboard'));
        }

        return view('admin.orders.show')->with('order', $order);
    }

}
