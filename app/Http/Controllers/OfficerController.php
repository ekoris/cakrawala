<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeEloquent;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    protected $repository;

    public function __construct(EmployeeEloquent $repository)
    {
        $this->repository = $repository;
        $this->view = 'admin.employee.';
        $this->route = 'admin.employee';
    }

    public function index(Request $request)
    {
        $repositories = $this->repository->fetch($request->all());
        return view($this->view.'index', compact('repositories'));
    }
}