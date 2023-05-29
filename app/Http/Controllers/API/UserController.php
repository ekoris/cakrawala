<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\API\UserEloquent;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
   protected $user;

   public function __construct(UserEloquent $user)
   {
      $this->user = $user;
   }
   
   public function info(Request $request)
   {
      return $this->sendResponse(
         array_merge(
         logged_in_user()->toArray(),[
         'total_saving' => logged_in_user()->total_saving,
         'allow_credit' => $this->user->credit(),
         'profile_picture' => logged_in_user()->url_profile_picture
      ]), 'Informasi User Login');
   }

   public function update(UserRequest $request)
   {
      try {
         $user = $this->user->update($request->data(), logged_in_user()->id);
         return $this->sendResponse($user, 'Data Berhasil di update');
      } catch (\Throwable $th) {
         throw $th;
         return $this->sendError('data error');
      }
   }

   public function updatePassword(Request $request)
   {
      try {
         if (Hash::check($request->password, logged_in_user()->password)) {
            $user = $this->user->updatePassword($request->all(), logged_in_user()->id);
            return $this->sendResponse($user, 'Data Berhasil di update');
         }else{
            return $this->sendError('Password Lama anda tidak sama', logged_in_user(), 401);
         }
      } catch (\Throwable $th) {
         throw $th;
         return $this->sendError('data error');
      }
   }
}