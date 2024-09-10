<?php
namespace Modules\Groups\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Groups\src\Models\Groups;
use Modules\Groups\src\Models\Modules;
use Yajra\DataTables\Facades\DataTables;
use Modules\Groups\src\Http\Requests\GroupsRequest;
use Modules\Groups\src\Repositories\GroupsRepository;
use Modules\Groups\src\Repositories\ModulesRepository;
use Modules\Groups\src\Repositories\GroupsRepositoryInterface;
use Modules\Groups\src\Repositories\ModulesRepositoryInterface;


class GroupsController extends Controller{
    protected $GroupsRepository;

    public function __construct(GroupsRepositoryInterface $GroupsRepository, ModulesRepositoryInterface $ModulesRepository){
        $this->GroupsRepository = $GroupsRepository;
        $this->ModulesRepository = $ModulesRepository;
    }


    public function index(){
       
        $pageTitle = 'Nhóm người dùng';
        

        return view('groups::lists', compact('pageTitle'));
    }

    // public function detail($id){
    //     // return '<h1>Detail '.$id.'</h1>';
    //     return view('user::detail', compact('id'));
    // }

    public function data(){
        $groups = $this->GroupsRepository->getGroups();

        return DataTables::of($groups)

        
        ->addColumn('edit', function ($group) {
            if (auth()->user()->can('update', $group)) {
                return '<a href ="'.route('admin.groups.edit', $group->id).'" class="btn btn-warning">Sửa</a>';
            }
            return ''; // Return an empty string if no permission
        })
        ->addColumn('delete', function ($group) {
            if (auth()->user()->can('delete', $group)) {
                return '<a href ="'.route('admin.groups.delete', $group->id).'" class="btn btn-danger delete-action">Xóa</a>';
            }
            return ''; // Return an empty string if no permission
        })

        ->addColumn('permissions', function ($group) {
            if (auth()->user()->can('permission', $group)) {
                return '<a href ="'.route('admin.groups.permissions', $group->id).'" class="btn btn-primary">Phân quyền</a>';
            }
            return ''; // Return an empty string if no permission
        })
        // ->editColumn('permissions', function($group) {
        //     return '<a href ="'.route('admin.groups.permissions', $group->id).'" class="btn btn-primary">Phân quyền</a>';
        // })

        ->rawColumns(['edit', 'delete', 'permissions'])
        ->toJson();
    }

    public function create(){
        $pageTitle = 'Thêm nhóm';

        return view('groups::add', compact('pageTitle'));
    }


    public function store(GroupsRequest $request){
        $this->GroupsRepository->create([
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.groups.index')->with('msg', __('groups::messages.create.success'));
    }


    public function edit($id){
        $group = $this->GroupsRepository->find($id);
        if(!$group){
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa thông tin nhóm';

        return view('groups::edit', compact('group', 'pageTitle'));
    }


    public function update(GroupsRequest $request, $id){
        // lấy ra tất cả dữ liệu từ request ngoại trừ _token và password
        $data = $request->except('_token', 'password');
        
        $this->GroupsRepository->update($id, $data);

        return back()->with('msg', __('groups::messages.update.success'));
    }

    public function delete($id){
  
        $group = $this->GroupsRepository->delete($id);
        return back()->with('msg', __('groups::messages.delete.success'));
    }


    public function permissions($id){
        $group = $this->GroupsRepository->find($id);
        
        if(!$group){
            abort(404);
        }
        $pageTitle = 'Phân quyền nhóm: '.$group->name;
        $modules = $this->ModulesRepository->getModules();

        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];

        $roleJson = $group->permissions;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
        }else{
            $roleArr = [];
        }


        return view('groups::permissions', compact('group','pageTitle' ,'modules', 'roleListArr', 'roleArr'));
    }


    public function postPermissions(Groups $group, Request $request){
        // $this->authorize('permission', $group);
        if(!empty($request->role)){
            $roleArr = $request->role;
        }else {
            $roleArr = [];
        }

        $roleJson = json_encode($roleArr);
        $group->permissions = $roleJson;
        $group->save();
        return back()->with('msg', 'Phân quyền thành công!');

    }



}


 














