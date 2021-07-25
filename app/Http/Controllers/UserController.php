<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
use App\Services\UserService;
use PDF;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->service->getChildUsers($request->user());

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUser $request)
    {
        $data = $request->validated();

        $this->service->registerByUser($request->user(), $data);

        return redirect('users');
    }

    public function pdf(Request $request)
    {
        $users = $this->service->getChildUsers($request->user(), false);

        $pdf = PDF::loadView('users.pdf', compact('users'));

        return $pdf->download('users_' . date('d-m-Y') . '.pdf');
    }
}
