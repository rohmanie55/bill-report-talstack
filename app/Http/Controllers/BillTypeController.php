<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use Illuminate\Http\Request;

class BillTypeController extends Controller
{
    public function index(){
        return view('pages.bill-type.index', [
            'types'=>BillType::query()->paginate(10)
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $validated = $request->validate([
                'name'=> 'required|max:100',
                'amount'=>'required|numeric',
                'description'=>'nullable'
            ]);

            $validated['code'] = BillType::generateCode();

            (new BillType)->fill($validated)->save();

            return redirect(route('type.index'))->with('success','Successfull Create!');
        }

        return view('pages.bill-type.input');
    }

    public function edit(Request $request, $id){
        if($request->isMethod("POST")){
            $validated = $request->validate([
                'name'=> 'required|max:100',
                'amount'=>'required|numeric',
                'description'=>'nullable'
            ]);
 
            (new BillType)->find($id)->fill($validated)->save();

            return redirect(route('type.index'))->with('success','Successfull Update!');
        }

        return view('pages.bill-type.input',[
            'item'=>BillType::find($id)
        ]);
    }

    public function destroy($id){
        try {
            BillType::find($id)->delete();
            return redirect(route('type.index'))->with('success','Successfull Delete!');
        } catch (\Throwable $th) {
            return redirect(route('type.index'))->with('fail','Failed to Delete!');
        }
    }
}
