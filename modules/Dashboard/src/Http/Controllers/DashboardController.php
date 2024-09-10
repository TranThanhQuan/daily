<?php
namespace modules\Dashboard\src\Http\controllers;
use App\Http\Controllers\Controller;


class DashboardController extends Controller{
    public function index(){
        // $pageTitle = 'Trang tổng quan';
        // return view('dashboard::dashboard', compact('pageTitle'));
        return redirect(route('admin.payments.index'));
    }
}





