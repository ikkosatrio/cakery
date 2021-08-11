<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Globals;


class DashboardController extends Controller
{
    //

    public function index()
    {
        $data['title'] =  "Dashboard";
        return view("admin/dashboard",compact('data'));
    }

    public function notFound()
    {
        $data['title'] = "page not found";
        return view("admin/notfound",compact('data'));
    }
}
