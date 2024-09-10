<?php
namespace Modules\Payments\src\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Agents\src\Models\Agent;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Modules\Report\src\Http\Requests\ReportRequest;
use Modules\Agents\src\Repositories\AgentsRepository;
use Modules\Payments\src\Http\Requests\PaymentsRequest;
use Modules\Payments\src\Repositories\PaymentsRepository;
use Modules\Agents\src\Repositories\AgentsRepositoryInterface;
use Modules\Payments\src\Repositories\PaymentsRepositoryInterface;

class PaymentsController extends Controller {
    protected $paymentsRepository;

    public function __construct(PaymentsRepositoryInterface $paymentsRepository, AgentsRepositoryInterface $AgentsRepository){
        $this->paymentsRepository = $paymentsRepository;
        $this->agentsRepository = $AgentsRepository;
    }

    public function index(){
        $pageTitle = 'Quản lý nạp';

        $user = Auth::user();
        if($user->can('viewAny')){
            return 'được phép';
        }

        return view('payments::lists', compact('pageTitle'));
    }

    public function data(){
        $payments = $this->paymentsRepository->getPayments();
        $dataTable = DataTables::of($payments)
            ->addColumn('amount', function ($payment) {
                return $this->formatAmount($payment->amount);
            })      
            ->editColumn('status', function($payment) {

                if($payment->user_id == null){
                    return '<p class="">Chưa chuyển GP</p>';
                }else{
                    return '<p class="">Đã chuyển GP</p>';
                }
            })

            ->editColumn('confirmer', function($payment) {
                if($payment->user){
                    return $payment->user->name;
                }else{
                    return '';
                }
            })
            ->editColumn('created_at', function($payment) {
                return Carbon::parse($payment->created_at)->format('d/m/Y H:i:s');
            })
            
            ->addColumn('confirm', function ($payment) {

                if (auth()->user()->can('confirm', $payment)) {
                    if($payment->user_id == null){
                        $user_id = Auth::user()->id;
                        $payment_id = $payment->id;
    
                        $csrf = csrf_token(); // Lấy token CSRF
                        return '
                            <form action="" method="POST">
                                <input type="hidden" name="user_id" value="' . $user_id . '">
                                <input type="hidden" name="payment_id" value="' . $payment_id . '">
    
                                <input type="hidden" name="_token" value="' . $csrf . '">
                                <button type="submit" class="btn btn-warning">Chưa xác nhận</button>
                            </form>';
    
                    }else{
                        return '<p class="btn btn-primary">Đã xác nhận</p>';
    
                    }
                }
                return '';
            })
            ->rawColumns(['confirm', 'status'])
            ->toJson();
    
        return $dataTable;
    }


    public function create(){
        $pageTitle = 'Thêm giao dịch';
        $agents = Agent::all();
        return view('payments::add', compact('pageTitle', 'agents'));
    }

    public function store(PaymentsRequest $request){
        $agent = $this->agentsRepository->find($request->agent)->name;
        // dd($agent);
        $this->paymentsRepository->create([
            'agent' => $agent,
            'agent_id' => $request->agent,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_id' => 0,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.payments.index')->with('msg', __('user::messages.create.success'));
    }

    public function update(Request $request){
        $id = $request->payment_id;

        $data = $request->except('_token', 'id_payment');
        
        $this->paymentsRepository->updatePayment($id, $data);

        return back()->with('msg', __('payments::messages.update.success'));
    }

    public function formatAmount($amount){
        // Sử dụng hàm number_format để định dạng số
        return number_format($amount, 0, ',', '.') . ' vnđ';
    }
    
    public function report(){
        $pageTitle = 'Đối soát đại lý';
        $agents = Agent::all();
        return view('payments::report', compact('pageTitle', 'agents'));
    }

    public function showReport(ReportRequest $request) {
        $pageTitle = 'Đối soát đại lý';
        $agents = Agent::all();

        $data = $request->except('_token');
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
    
        if (strtotime($start_date) > strtotime($end_date)) {
            return view('payments::report', compact('pageTitle', 'agents', 'data'))
                    ->with('error', 'Ngày bắt đầu không được lớn hơn ngày kết thúc!');
        }
    
        // // Thực hiện logic để lấy báo cáo từ cơ sở dữ liệu
        $dataReport = $this->paymentsRepository->getDataReport($data);

        foreach ($dataReport['data'] as &$report) {
            $date = Carbon::parse($report['created_at']);
            $report['created_at'] = $date->format('d-m-Y H:i:s');
        }

        if (empty($dataReport['data'])) {
            return view('payments::report', compact('pageTitle', 'agents', 'data'))
                    ->with('error', 'Không có dữ liệu nạp phù hợp trong khoảng thời gian này!');
        }else{
            
                return view('payments::report', compact('pageTitle', 'agents', 'data'))
                            ->with('dataReport', $dataReport);
        }
    }
    
    public function export(ReportRequest $request){
        $data = $request->except('_token');

        // Tạo một đối tượng Spreadsheet mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Đổi tên sheet mặc định

        $sheet->setTitle($data['agent']);
        $filename = 'DoiSoatDaiLy_'.$data['agent'].'.xlsx';


        // Thiết lập tiêu đề cho các cột
        $sheet->setCellValue('A1', 'STT');
        $sheet->setCellValue('B1', 'Tên đại lý');
        $sheet->setCellValue('C1', 'Số tiền nạp');
        $sheet->setCellValue('D1', 'Mô tả');
        $sheet->setCellValue('E1', 'Thời gian nạp');
        
        // Dữ liệu ví dụ (thay thế bằng dữ liệu thực tế của bạn)
        $dataReport = $this->paymentsRepository->getDataReport($data);
        // dd($dataReport);

        foreach ($dataReport['data'] as &$report) {
            $date = Carbon::parse($report['created_at']);
            $report['created_at'] = $date->format('d-m-Y H:i:s');
        }
        
        // Nhập dữ liệu vào file
        $row = 2;


        foreach ($dataReport['data'] as $key => $data) {
            $sheet->setCellValue('A' . $row, $key+1);
            $sheet->setCellValue('B' . $row, $data['agent']);
            $sheet->setCellValue('C' . $row, $data['amount']);
            $sheet->setCellValue('D' . $row, $data['description']);
            $sheet->setCellValue('E' . $row, $data['created_at']);
            $row++;
        }
        // Tạo writer và lưu file
        $writer = new Xlsx($spreadsheet);
        
        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            ]
        );
    }


    public function webhook(Request $request){
        $data = $request->all();
        $agents = Agent::all();
        $agents = $agents->map(function ($agent) {
            return [
                'agent_id' => $agent->id,
                'agent' => $agent->name,
                'syntax' => $agent->syntax
            ];
        });

        if ($data['error'] !== 0) {
            return response()->json(['message' => 'Có lỗi trong dữ liệu'], 400);
        }

        $data = $data['data'][0];

        return $this->paymentsRepository->webhook($data, $agents);
    }


}





