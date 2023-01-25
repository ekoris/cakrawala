<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Repositories\API\ProductEloquent;
use Illuminate\Http\Request;
use App\Repositories\API\UserEloquent;

class ProductController extends BaseController
{
   protected $product;

   public function __construct(ProductEloquent $product)
   {
      $this->product = $product;
   }
   
   public function product(Request $request)
   {
      return ProductCollection::collection($this->product->fetchProduct($request->all()));
   }

   public function detailProduct($idProduct)
   {
      $product = $this->product->find($idProduct);
      return $this->sendResponse($product, '');
   }

   public function categoryProduct(Request $request)
   {
      return CategoryProductCollection::collection($this->product->fetchCategoryProduct($request->all()));
   }
}