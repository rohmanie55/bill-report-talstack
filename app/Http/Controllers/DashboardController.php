<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->role=='admin'){
        $year = request('year',now()->year);
        $billReport =Bill::selectRaw('
            users.name, 
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 1 THEN pay_amount ELSE 0 END) AS jan,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 2 THEN pay_amount ELSE 0 END) AS feb,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 3 THEN pay_amount ELSE 0 END) AS mar,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 4 THEN pay_amount ELSE 0 END) AS apr,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 5 THEN pay_amount ELSE 0 END) AS mei,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 6 THEN pay_amount ELSE 0 END) AS jun,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 7 THEN pay_amount ELSE 0 END) AS jul,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 8 THEN pay_amount ELSE 0 END) AS aug,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 9 THEN pay_amount ELSE 0 END) AS sep,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 10 THEN pay_amount ELSE 0 END) AS okt,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 11 THEN pay_amount ELSE 0 END) AS nov,
            SUM(CASE WHEN EXTRACT(MONTH FROM pay_date) = 12 THEN pay_amount ELSE 0 END) AS des,
            SUM(bill_amount) as total_bill,
            SUM(pay_amount) as total_pay,
            SUM(bill_amount)-SUM(pay_amount) as sum_bill
            ')
            ->join('users','users.id','bills.user_id')
            ->groupBy('users.id')
            ->groupBy(\DB::raw('EXTRACT(YEAR FROM pay_date)'))
            ->whereYear('pay_date',$year)
            ->where('status','paid')
            ->paginate();

        return view('pages.dashboard.admin',[
            'reports'=>$billReport,
            'minYear'=>Bill::selectRaw('MIN(EXTRACT(YEAR FROM pay_date)) as year')->first()->year-1
        ]);
        }else{

            return view('pages.dashboard.user',[
                'bills'=>Bill::query()->with('user:id,name','type:id,name')->where('user_id',auth()->id())->paginate(10)
            ]);
        }
    }
}
