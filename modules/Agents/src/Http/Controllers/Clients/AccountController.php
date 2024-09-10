<?php
namespace Modules\Agents\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Agents\src\Repositories\AgentsRepositoryInterface;


class AccountController extends Controller{

    protected $agentRepository;

    public function __construct(AgentsRepositoryInterface $agentRepository){
        $this->agentRepository = $agentRepository;
    }
    public function index(){
       return 'index';
    }


    public function profile(){
        $agent = Auth::guard('agents')->user();
        
        $pageTitle = 'Thông tin đại lý: '.$agent->name;

        $agent['game'] = implode(' - ', json_decode($agent['game'], true));

        
        // thông tin nạp 
        $agent['tongNapThangNay'] = checkAgentMonthly('thisMonth', $agent->name)['tongNap'];
        $agent['tongNap1thangtruoc'] = checkAgentMonthly('previousMonth', $agent->name)['tongNap'];
        $agent['tongNap2thangtruoc'] = checkAgentMonthly('twoMonthsAgo', $agent->name)['tongNap'];

        $agent['hoaHongThangNay'] =  checkAgentMonthly('thisMonth', $agent->name)['hoaHong'];
        $agent['hoaHong1ThangTruoc'] = checkAgentMonthly('previousMonth', $agent->name)['hoaHong'];
        $agent['hoaHong2ThangTruoc'] = checkAgentMonthly('twoMonthsAgo', $agent->name)['hoaHong'];

        return view('agents::clients.account', compact('pageTitle', 'agent'));
    }


    public function data()
        {
            $agents = $this->agentRepository->getAllAgents();

            return DataTables::of($agents)
                ->addColumn('thisMonth', function ($agent) {
                    return checkAgentMonthly('thisMonth', $agent->name)['tongNap'];
                })
                ->addColumn('previousMonth', function ($agent) {
                    return checkAgentMonthly('previousMonth', $agent->name)['tongNap'];
                })
                ->addColumn('twoMonthsAgo', function ($agent) {
                    return checkAgentMonthly('twoMonthsAgo', $agent->name)['tongNap'];
                })
                ->addColumn('commissionThisMonth', function ($agent) {
                    return checkAgentMonthly('thisMonth', $agent->name)['hoaHong'];
                })
                ->addColumn('commissionPreviousMonth', function ($agent) {
                    return checkAgentMonthly('previousMonth', $agent->name)['hoaHong'];
                })
                ->addColumn('commissionTwoMonthsAgo', function ($agent) {
                    return checkAgentMonthly('twoMonthsAgo', $agent->name)['hoaHong'];
                })
                ->addColumn('detail', function ($agent) {
                    // if (auth()->user()->can('viewAny', $agent)) {
                        return '<a href ="' . route('admin.agents.detail', $agent->id) . '" class="btn btn-primary">Xem</a>';
                    // }
                    return ''; 
                })
                ->addColumn('edit', function ($agent) {
                    if (auth()->user()->can('update', $agent)) {
                        return '<a href ="' . route('admin.agents.edit', $agent->id) . '" class="btn btn-warning">Sửa</a>';
                    }
                    return ''; 
                })
                ->addColumn('delete', function ($agent) {
                    if (auth()->user()->can('delete', $agent)) {
                        return '<a href ="' . route('admin.agents.delete', $agent->id) . '" class="btn btn-danger delete-action">Xóa</a>';
                    }
                    return ''; 
                })
                ->rawColumns(['edit', 'delete', 'detail', 'thisMonth', 'previousMonth', 'twoMonthsAgo', 'commissionThisMonth', 'commissionPreviousMonth', 'commissionTwoMonthsAgo'])
                ->toJson();
        }


}


 














