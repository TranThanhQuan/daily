<?php
namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;


class HomeController extends Controller{

    public function __construct(){
        
    }

    public function index(){
        $pageTitle = "Danh sách nạp";
        return redirect(route('payments.index'));

        // return view('home::index', compact('pageTitle'));
    }
}


 














