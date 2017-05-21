<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * DepartmentController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.panel');
    }
}
