<?php

namespace App\Http\Controllers;

use App\Repositories\ProductEloquent;
use Illuminate\Http\Request;

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

}
