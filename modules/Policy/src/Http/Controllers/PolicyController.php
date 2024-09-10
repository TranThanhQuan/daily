<?php

namespace Modules\Policy\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Groups\src\Models\Groups;
use Modules\Policy\src\Models\Policy;
use Yajra\DataTables\Facades\DataTables;
use Modules\Policy\src\Http\Requests\PolicyRequest;
use Modules\Groups\src\Repositories\GroupsRepository;
use Modules\Policy\src\Repositories\PolicyRepository;
use Modules\Policy\src\Repositories\PolicyRepositoryInterface;



class PolicyController extends Controller{

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

        return view('policy::lists', compact('policy', 'pageTitle'));
    }
    
    
    public function edit(){
        $policy = $this->policyRepository->getPolicy('1');
        
        if(!$policy){
            abort(404);
        }
        // $groups = Groups::all();
        $pageTitle = 'Chỉnh sửa chính sách đại lý';

        return view('policy::edit', compact('policy', 'pageTitle'));
    }


    public function update(PolicyRequest $request, $id=1){
        // lấy ra tất cả dữ liệu từ request ngoại trừ _token và password
        $data = $request->except('_token', 'password');
        
        // gọi phương thức update trontg BaseRepository
        $this->policyRepository->update($id, $data);

        return back()->with('msg', __('policy::messages.update.success'));
    }

    
    public function uploadImage(Request $request)
    {
        // dd($request);
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Chuyển tệp vào thư mục 'public/media'
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);

            return response()->json(['filename' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }

        // Trả về lỗi nếu không có tệp nào được tải lên
        return response()->json(['uploaded' => 0, 'error' => ['message' => 'No file uploaded.']], 400);
    }


    
}




