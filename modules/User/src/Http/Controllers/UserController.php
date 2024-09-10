<?php
namespace Modules\User\src\Http\Controllers;

use Carbon\Carbon;
use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Groups\src\Models\Groups;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepository;
use Modules\Groups\src\Repositories\GroupsRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;

class UserController extends Controller{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, GroupsRepository $GroupsRepository){
        $this->userRepository = $userRepository;
        $this->GroupsRepository = $GroupsRepository;
    }


    public function index(){
        $pageTitle = 'Quản lý người dùng';

        return view('user::lists', compact('pageTitle'));
    }

    public function detail($id){
        return view('user::detail', compact('id'));
    }

    public function data() {
        $users = $this->userRepository->getAllUsers();
        $dataTable = DataTables::of($users)
            ->addColumn('edit', function ($user) {
                if (auth()->user()->can('update', $user)) {
                    return '<a href ="'.route('admin.users.edit', $user->id).'" class="btn btn-warning">Sửa</a>';
                }
                return ''; // Return an empty string if no permission
            })
            ->addColumn('delete', function ($user) {
                if (auth()->user()->can('delete', $user)) {
                    return '<a href ="'.route('admin.users.delete', $user->id).'" class="btn btn-danger delete-action">Xóa</a>';
                }
                return ''; // Return an empty string if no permission
            })
            ->editColumn('created_at', function($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('group_id', function ($user) {
                return $user->group->name;
            })
            ->rawColumns(['edit', 'delete', 'group_id'])
            ->toJson();
    
        return $dataTable;
    }
    
    
    
    

    public function create(){
        $pageTitle = 'Thêm người dùng';
        $groups = Groups::all();

        return view('user::add', compact('pageTitle', 'groups'));
    }


    public function store(UserRequest $request){
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'password' => bcrypt($request->password),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.users.index')->with('msg', __('user::messages.create.success'));
    }


    public function edit($id){
        $user = $this->userRepository->find($id);
        if(!$user){
            abort(404);
        }
        $groups = Groups::all();
        $pageTitle = 'Chỉnh sửa thông tin người dùng';

        return view('user::edit', compact('user', 'pageTitle', 'groups'));
    }


    public function update(UserRequest $request, $id){
        // lấy ra tất cả dữ liệu từ request ngoại trừ _token và password
        $data = $request->except('_token', 'password');
        
        //nếu request có password (có nhập password) thì mã hóa password
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        
        // gọi phương thức update trontg BaseRepository
        $this->userRepository->update($id, $data);

        return back()->with('msg', __('user::messages.update.success'));
    }

    public function delete($id){
        $user = $this->userRepository->delete($id);

        return back()->with('msg', __('user::messages.delete.success'));
    }

}


 














