<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryProductEloquent;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryProductEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $repositories = $this->repository->fetch($request->all());
        return view('admin.product.category.index', compact('repositories'));
    }

    public function create(Request $request)
    {
        return view('admin.product.category.create');
    }

    public function store(Request $request)
    {
        try {
            $this->repository->store($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.category.index');
    }

    public function edit(Request $request, $id)
    {
        $repository = $this->repository->find($id);
        return view('admin.product.category.edit', compact('repository'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.category.index');
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.category.index');
    }

}
