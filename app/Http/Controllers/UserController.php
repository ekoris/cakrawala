<?php

namespace App\Http\Controllers;

use App\Repositories\UserEloquent;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $user;

    public function __construct(UserEloquent $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $users = $this->user->fetch($request->all());
        return view('admin.user.index', compact('users'));
    }

    public function create(Request $request)
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
        ]);

        try {
            $this->user->store($request->all());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
