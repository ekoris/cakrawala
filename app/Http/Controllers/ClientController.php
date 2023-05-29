<?php

namespace App\Http\Controllers;

use App\Repositories\ClientEloquent;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $repository;

    public function __construct(ClientEloquent $repository)
    {
        $this->repository = $repository;
        $this->view = 'admin.client.';
        $this->route = 'admin.client';
    }

    public function index(Request $request)
    {
        $repositories = $this->repository->fetch($request->all());
        return view($this->view.'index', compact('repositories'));
    }
}