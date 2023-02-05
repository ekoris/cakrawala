<?php

namespace App\Http\Controllers;

use App\Repositories\MarketEloquent;
use Illuminate\Http\Request;

class MasterMarketController extends Controller
{
    protected $repository;

    public function __construct(MarketEloquent $repository)
    {
        $this->repository = $repository;
        $this->view = 'admin.market.';
    }

    public function index(Request $request)
    {
        $repositories = $this->repository->fetch($request->all());
        return view($this->view.'index', compact('repositories'));
    }

    public function create(Request $request)
    {
        return view($this->view.'create');
    }

    public function store(Request $request)
    {
        try {
            $this->repository->store($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.master-market.index');
    }

    public function edit($id)
    {
        $repository = $this->repository->find($id);
        return view($this->view.'edit', compact('repository'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->repository->update($id, $request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.master-market.index');
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.master-market.index');
    }

}
