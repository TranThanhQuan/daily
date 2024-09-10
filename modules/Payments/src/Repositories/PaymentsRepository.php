<?php

namespace Modules\Payments\src\Repositories;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Modules\Payments\src\Models\Payments;
use Modules\Payments\src\Repositories\PaymentsRepositoryInterface;


class PaymentsRepository extends BaseRepository implements PaymentsRepositoryInterface{
    public function getModel(){
        return Payments::class;
    }

    public function getPayments($name = '')
    {
        $query = $this->model->select('id', 'agent', 'amount', 'description', 'user_id', 'created_at')
                            ->with(['user:id,name']);

        if (!empty($name)) {
            $query->where('agent', $name);
        }

        return $query->orderBy('id', 'desc')->get();
    }



    public function updatePayment($id, $attribute=[]){
        $result = $this->model->find($id);
        if(!$result->user_id){
            return $result->update($attribute);
        }
        return false;
    }


    public function getSumPaymentAgent($from, $to, $agent){
        return $this->model->where('agent', $agent)
        ->whereBetween('created_at', [$from, $to])
        ->sum('amount'); 
    }
    
    
    public function getDataReport($data)
        {
            $from = Carbon::parse($data['start_date'])->startOfDay();
            $to = Carbon::parse($data['end_date'])->endOfDay();

            $dataReport = $this->model->select('id', 'agent', 'amount', 'description', 'created_at')
                ->whereBetween('created_at', [$from, $to]);


            if ($data['agent'] === 'all') {
                $dataReport->whereNotNull('agent');
            } elseif ($data['agent'] === 'error') {
                $dataReport->whereNull('agent');
            } else {
                $dataReport->where('agent', $data['agent']);
            }
            // Lấy dữ liệu và chuyển đổi thành mảng
            $reports = $dataReport->get()->toArray();

            // Tính tổng giá trị cột 'amount'
            $totalAmount = array_sum(array_column($reports, 'amount'));
            if ($totalAmount >= 200000000) {
                $hoaHong = $totalAmount * 0.05;
            } else {
                $hoaHong = $totalAmount * 0.04;
            }

            // Format 'amount' thành dạng tiền VNĐ
            foreach ($reports as &$report) {
                $report['amount'] = number_format($report['amount'], 0, ',', '.') . ' VNĐ';
            }
            $totalAmountFormatted = number_format($totalAmount, 0, ',', '.') . ' VNĐ';
            $hoaHong = number_format($hoaHong, 0, ',', '.') . ' VNĐ';

            // Trả về dữ liệu theo cấu trúc yêu cầu
            return [
                'data' => $reports,
                'sumPayments' => $totalAmountFormatted,
                'hoaHong' => $hoaHong

            ];
    }


    public function webhook($data, $agents){
        $transaction_id = $data['id'];
        $description = $data['description'];
        $amount = $data['amount'];
        $when = $data['when'];


        //kiểm tra đã xử lý transaction này chưa
        $checkTransactionId = $this->model->where('transaction_id', $transaction_id)->first();
        $agent_id = null;
        $agent_name = 'Không xác định'; // Đổi tên biến để tránh xung đột
        foreach ($agents as $agent_item) {
            if (strpos($description, $agent_item['syntax']) !== false) {
                $agent_name = $agent_item['agent'];
                $agent_id = $agent_item['agent_id'];
                break;
            }
        }

        if (!$checkTransactionId) {
            try {
                // Lưu dữ liệu và kiểm tra kết quả
                $result = $this->model->create([
                    'agent' => $agent_name,
                    'agent_id' => $agent_id,
                    'amount' => $amount,
                    'description' => $description,
                    'transaction_id' => $transaction_id,
                    'created_at' => $when
                ]);
                
                if ($result) {
                    // Nếu ghi dữ liệu thành công, trả về success
                    return response()->json(['status' => 'success', 'message' => 'Data saved successfully.'], 200);
                } else {
                    // Nếu không thành công, trả về lỗi
                    return response()->json(['status' => 'error', 'message' => 'Failed to save data.']);
                }
            } catch (\Exception $e) {
                // Xử lý ngoại lệ và trả về lỗi
                return response()->json(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        }else{
            return response()->json(['status' => 'success', 'message' => 'transaction already exists'], 200);
        }
        
    }





}















