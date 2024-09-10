<?php

namespace Modules\Auth\src\Http\Controllers\clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    
    public function __construct()
    {

    } 

    public function index(Request $request){
        $user = $request->user();
        if($user->status){
            return redirect()->route('home');
        }

        $pageTitle = "Tài khoản đã bị vô hiệu hóa";
        return view('auth::clients.block', compact('pageTitle'));
    }
    

}
