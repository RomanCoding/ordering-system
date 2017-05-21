<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    /**
     * DepartmentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->expectsJson()) {
            return Department::all();
        }
    }

    public function store(Request $request)
    {
        $this->middleware('admin');
        $department = Department::create($request->all());
        if ($request->expectsJson()) {
            return $department;
        }
    }
}
