<?php

namespace App\Http\Controllers;

use App\Repositories\ProductEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(ProductEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $products = $this->repository->fetch($request->all());
        return view('admin.product.index', compact('products'));
    }

    public function create(Request $request)
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        try {
            $this->repository->store($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.product.index');
    }

    public function edit(Request $request, $id)
    {
        $product = $this->repository->find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.product.index');
    }

    public function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.product.index');
    }

}
