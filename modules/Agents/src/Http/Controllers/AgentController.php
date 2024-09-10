<?php
namespace Modules\Agents\src\Http\Controllers;

use Modules\Games\src\Models\Games;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Modules\Agents\src\Http\Requests\AgentRequest;
use Modules\Agents\src\Repositories\AgentsRepositoryInterface;


class AgentController extends Controller{

    protected $agentRepository;

    public function __construct(AgentsRepositoryInterface $agentRepository){
        $this->agentRepository = $agentRepository;
    }

    public function index(){
        $pageTitle = 'Danh sách Đại lý';
        return view('agents::lists', compact('pageTitle'));
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


    public function create(){
        $pageTitle = 'Thêm đại lý';
        $games = Games::all();


        return view('agents::add', compact('pageTitle', 'games'));
    }

    public function store(AgentRequest $request){
        $user_id = Auth::user()->id; 

        $this->agentRepository->create([
            'name' => $request->name,
            'creator' => $user_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'code_agent' => $request->code_agent,
            'game' => json_encode($request->games, JSON_UNESCAPED_UNICODE),
            'syntax' => $request->syntax,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'bank_account' => $request->bank_account,
            'status' => 1
        ]);

        return redirect()->route('admin.agents.index')->with('msg', __('user::messages.create.success'));
    }

    public function detail($id){
        $agent = $this->agentRepository->find($id);

        if(!$agent){
            abort(404);
        }
        $pageTitle = 'Thông tin đại lý: ' . $agent->name;
        
        $games = Games::all();
        return view('agents::detail', compact( 'pageTitle', 'games' , 'agent'));
    }


    public function edit($id){
        $agent = $this->agentRepository->find($id);
        if(!$agent){
            abort(404);
        }
        
        $games = Games::all();
        $pageTitle = 'Chỉnh sửa thông tin đại lý: ' . $agent->name;
        return view('agents::edit', compact( 'pageTitle', 'agent', 'games'));
    }


    public function update(AgentRequest $request, $id){
        $data = $request->except('_token', 'password');
        $data['game'] = json_encode($request->games, JSON_UNESCAPED_UNICODE);
        
        //  //nếu request có password (có nhập password) thì mã hóa password
        if($request->password){
             $data['password'] = bcrypt($request->password);
        }
        $this->agentRepository->update($id, $data);
        return back()->with('msg', __('agents::messages.update.success'));
    }

    public function delete($id){
        
        $this->agentRepository->delete($id);

        return back()->with('msg', __('agents::messages.delete.success'));
    }

}


 














