<?php
namespace Modules\Games\src\Http\Controllers;

use Carbon\Carbon;
use Modules\Games\src\Models\Games;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\Games\src\Http\Requests\GamesRequest;
use Modules\Games\src\Repositories\GamesRepository;
use Modules\Games\src\Repositories\GamesRepositoryInterface;

class GamesController extends Controller{
    protected $GamesRepository;

    public function __construct(GamesRepositoryInterface $GamesRepository){
        $this->GamesRepository = $GamesRepository;
    }


    public function index(){
        $pageTitle = 'Danh sách Games';
        
        return view('games::lists', compact('pageTitle'));
    }

    // public function detail($id){
    //     // return '<h1>Detail '.$id.'</h1>';
    //     return view('user::detail', compact('id'));
    // }

    public function data(){
        $games = $this->GamesRepository->getGames();
        return DataTables::of($games)
        ->addColumn('edit', function ($user) {
            if (auth()->user()->can('update', $user)) {
                return '<a href ="'.route('admin.games.edit', $user->id).'" class="btn btn-warning">Sửa</a>';
            }
            return ''; // Return an empty string if no permission
        })
        ->addColumn('delete', function ($user) {
            if (auth()->user()->can('delete', $user)) {
                return '<a href ="'.route('admin.games.delete', $user->id).'" class="btn btn-danger delete-action">Xóa</a>';
            }
            return ''; // Return an empty string if no permission
        })
        ->editColumn('created_at', function($user) {
            return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])
        ->toJson();
    }


    public function create(){
        $pageTitle = 'Thêm game';

        return view('games::add', compact('pageTitle'));
    }


    public function store(GamesRequest $request){
        $this->GamesRepository->create([
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.games.index')->with('msg', __('user::messages.create.success'));
    }


    public function edit($id){
        $game = $this->GamesRepository->find($id);
        if(!$game){
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa thông tin game';

        return view('games::edit', compact('game', 'pageTitle'));
    }


    public function update(GamesRequest $request, $id){
        $data = $request->except('_token', 'password');
        
        $this->GamesRepository->update($id, $data);

        return back()->with('msg', __('games::messages.update.success'));
    }

    public function delete($id){
  
        $games = $this->GamesRepository->delete($id);
        return back()->with('msg', __('games::messages.delete.success'));
    }

}


 














