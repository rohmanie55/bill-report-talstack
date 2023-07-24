<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillType;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(){
        return view('pages.bill.index', [
            'bills'=>Bill::query()->with('user:id,name','type:id,name')->paginate(10)
        ]);
    }

    public function approve(Request $request){
        if($request->isMethod('POST')){
            $bill=Bill::find($request->id);
            $bill->status=$request->approve=='Y'?'paid':'canceled';
            $bill->approve_at=$request->approve=='Y'?now():null;
            $bill->approve_by=$request->approve=='Y'?auth()->id():null;
            $bill->save();
            return redirect(route('bill.approve'))->with('success','Successfull'.($request->approve=='Y'?'Approve':'Reject').'!');
        }
        return view('pages.bill.approve', [
            'bills'=>Bill::query()->with('user:id,name','type:id,name')->where('status','submited')->paginate(10)
        ]);
    }

    public function submit(Request $request){
        $request->validate([
            'pay_amount'=>'required',
            'pay_slip'=>'required|image|max:8192'
        ]);

        $bill=Bill::find($request->id);
        $bill->pay_amount=$request->pay_amount;
        $bill->status='submited';
        $bill->pay_date=now();
        $bill->pay_slip=$request->file('pay_slip')->store('public');
        $bill->save();

        return redirect(route('dashboard'))->with('success','Successfull Submit!');
    }

    public function paid(){
        return view('pages.bill.paid', [
            'bills'=>Bill::query()->with('user:id,name','type:id,name')->where('status','paid')->where('user_id',auth()->id())->paginate(10)
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $validated = $request->validate([
                'user_id'=> 'required|exists:users,id',
                'type_id'=>'required',
                'admin_note'=>'nullable'
            ]);
            
            $validated['bill_amount']=BillType::select('amount')->find($validated['type_id'])->amount;
            $validated['code'] = Bill::generateCode();

            (new Bill)->fill($validated)->save();

            return redirect(route('bill.index'))->with('success','Successfull Create!');
        }

        return view('pages.bill.input',[
            'users' => User::select('id','name')->where('role','user')->get(),
            'types' => BillType::select('id','name','amount')->get()
        ]);
    }

    public function edit(Request $request, $id){
        if($request->isMethod("POST")){
            $validated = $request->validate([
                'user_id'=> 'required|exists:users,id',
                'type_id'=>'required',
                'admin_note'=>'nullable'
            ]);
 
            (new Bill)->find($id)->fill($validated)->save();

            return redirect(route('bill.index'))->with('success','Successfull Update!');
        }

        return view('pages.bill.input',[
            'item'=>Bill::find($id),
            'users' => User::select('id','name')->where('role','user')->get(),
            'types' => BillType::select('id','name','amount')->get()
        ]);
    }

    public function destroy($id){
        try {
            Bill::find($id)->delete();
            return redirect(route('bill.index'))->with('success','Successfull Delete!');
        } catch (\Throwable $th) {
            return redirect(route('bill.index'))->with('fail','Failed to Delete!');
        }
    }
}
