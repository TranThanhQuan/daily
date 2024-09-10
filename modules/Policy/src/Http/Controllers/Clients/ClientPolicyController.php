<?php

namespace Modules\Policy\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Policy\src\Repositories\PolicyRepositoryInterface;



class ClientPolicyController extends Controller{

    protected $policyRepository;

    public function __construct(PolicyRepositoryInterface $policyRepository){
        $this->policyRepository = $policyRepository;
    }


    public function index(){
        $policy = $this->policyRepository->getPolicy('1');
        
        if(!$policy){
            abort(404);
        }
        $pageTitle = 'Chính sách đại lý';
        return view('policy::clients.policy', compact('pageTitle', 'policy'));

    }
    
    
}




