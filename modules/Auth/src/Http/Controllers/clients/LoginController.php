<?php

namespace Modules\Auth\src\Http\Controllers\clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Modules\Auth\src\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    public function __construct()
    {

        $this->middleware('guest:agents', ['except' => 'logout']);
        // $this->middleware('auth')->only('logout');
    } 


    public function showLoginForm()
    {
        $pageTitle = "Đăng nhập";

        return view('auth::clients.login', compact('pageTitle'));
    }


    public function login(LoginRequest $request){
        // dd($request->all());
        $dataLogin = $request->except('_token', 'remember');
        //trạng thái ghi nhớ đăng nhập
        $status = Auth::guard('agents')->attempt($dataLogin, $request->remember == 1 ? true:false);
        
        if($status){
            return redirect('/');
        }
        return back()->with('msg', 'Thông tin đăng nhập không chính xác');

    }


    public function logout(){
        Auth::guard('agents')->logout();
        return back();
    }

}
