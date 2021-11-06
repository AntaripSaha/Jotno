<?php

namespace App\Http\Controllers\Backend\AppointmentModule;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentModule\Charge;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ChargeController extends Controller
{
    //index function start
    public function index(){
        if( can("all_charge") ){
            return view("backend.modules.appointment_module.all_charge.index");
        }
        else{
            return view("errors.404");
        }
    }
    //index function end


    //data function start
    public function data(){
        if( can('all_charge') ){
            $charge = Charge::select("id","type","amount","is_active")->get();

            return DataTables::of($charge)
            ->rawColumns(['action', 'is_active'])
            ->editColumn('is_active', function (Charge $charge) {
                if ($charge->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->addColumn('action', function (Charge $charge) {
                return '

                    '.( can("edit_charge") ? '
                    <button type="button" data-content="'.route('charge.edit.modal',$charge->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                        Edit
                    </button>
                    ': '') .'

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }
    //data funciton end


    //add modal function start
    public function add_modal(){
        if( can("add_charge") ){
            return view("backend.modules.appointment_module.all_charge.modals.add");
        }
        else{
            return view("errors.404");
        }
    }
    //add modal function end


    //add function start
    public function add(Request $request){
        if( can("add_charge") ){
            $validator = Validator::make($request->all(),[
                'type' => 'required|unique:charges,type,',
                'amount' => 'required|numeric',
            ]);
            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $charge = new Charge();
                    $charge->type = $request->type;
                    $charge->amount = $request->amount;
                    $charge->is_active = true;

                    if( $charge->save() ){
                        return response()->json(['success' => 'New Charge Added'], 200);
                    }

                }
                catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }
        else{
            return view("errors.404");
        }
    }
    //add function end


    //edit modal function start
    public function edit_modal($id){
        if( can("edit_charge") ){
            $charge = Charge::find($id);
            return view("backend.modules.appointment_module.all_charge.modals.edit",compact('charge'));
        }
        else{
            return view("errors.404");
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request,$id){
        if( can("edit_charge") ){
            $validator = Validator::make($request->all(),[
                'type' => 'required|unique:charges,type,'.$id,
                'amount' => 'required|numeric',
                'is_active' => 'required',
            ]);
            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $charge = Charge::find($id);
                    $charge->type = $request->type;
                    $charge->amount = $request->amount;
                    $charge->is_active = $request->is_active;

                    if( $charge->save() ){
                        return response()->json(['success' => 'Charge Updated'], 200);
                    }

                }
                catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }
        else{
            return view("errors.404");
        }
    }
    //edit function end
}
