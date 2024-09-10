<?php
namespace Modules\Payments\src\Http\Controllers\Clients;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Payments\src\Repositories\PaymentsRepositoryInterface;
use Carbon\Carbon;


class PaymentsClientController extends Controller{

    public function __construct(PaymentsRepositoryInterface $paymentsRepository){
        $this->paymentsRepository = $paymentsRepository;

    }

    public function index(){
        $agent = Auth::guard('agents')->user()->name;
        $pageTitle = 'Danh sách nạp đại lý: '.$agent;
        // $payments = $this->paymentsRepository->getPayments($agent);
        
        return view('payments::clients.index', compact('pageTitle'));
    }


    public function data(){
        $agent = Auth::guard('agents')->user()->name;
        $payments = $this->paymentsRepository->getPayments($agent);
        $dataTable = DataTables::of($payments)
            ->addColumn('amount', function ($payment) {
                return number_format($payment->amount, 0, ',', '.') . ' vnđ';
                
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
            
            ->rawColumns(['confirm', 'status'])
            ->toJson();
    
        return $dataTable;
    }


    
}


 














