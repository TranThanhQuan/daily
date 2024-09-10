<?php

use Carbon\Carbon;
use Modules\Payments\src\Repositories\PaymentsRepository;

function isRole($dataArr, $moduleName, $role='view'){
    if(!empty($dataArr[$moduleName])){
        $roleArr = $dataArr[$moduleName];
        if(!empty($roleArr) && in_array($role, $roleArr)){
            return true;
        } 
    }

    return false;
}


function checkAgentMonthly($month, $agent){
    $PaymentsRepository = new PaymentsRepository();
    // Tính toán ngày tháng
    $now = Carbon::now();
    $dateRanges = [
        'thisMonth' => [
            'start' => $now->startOfMonth()->format('Y-m-d H:i:s'),
            'end' => $now->endOfMonth()->format('Y-m-d H:i:s')
        ],
        'previousMonth' => [
            'start' => $now->subMonth()->startOfMonth()->format('Y-m-d H:i:s'),
            'end' => $now->endOfMonth()->format('Y-m-d H:i:s')
        ]
    ];

    // Khôi phục lại giá trị gốc của Carbon
    $now = Carbon::now();

    // Tính toán ngày của hai tháng trước
    $dateRanges['twoMonthsAgo'] = [
        'start' => $now->subMonths(2)->startOfMonth()->format('Y-m-d H:i:s'),
        'end' => $now->endOfMonth()->format('Y-m-d H:i:s')
    ];
    
    $tongNap =  $PaymentsRepository->getSumPaymentAgent($dateRanges[$month]['start'], $dateRanges[$month]['end'], $agent);

    $commissionRate = ($tongNap > 200000000) ? 0.05 : 0.04;
    $hoaHong = $tongNap * $commissionRate;


    return  ['tongNap' => number_format($tongNap, 0, ',', '.') . ' vnđ',
             'hoaHong' => number_format($hoaHong, 0, ',', '.') . ' vnđ'];
}


