<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * WorkerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->expectsJson()) {
            return User::where('admin', 0)->get();
        }
    }

    public function store(Request $request)
    {
        $this->middleware('admin');
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());
        if ($request->expectsJson()) {
            return $user;
        }
    }
}
