<?php

namespace App\Http\Controllers\Backend\TestModule;

use App\Http\Controllers\Controller;
use App\Models\TestModule\ChiefComplaint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CheifComplaintsController extends Controller
{
   //index funciton start
   public function index(){
    if( can("all_chief_complaints") ){
        return view("backend.modules.test_module.all_cheif_complaints.index");
    }
    else{
        return view("errors.404");
    }
}   
//index funciton end


//view data
public function data(){
    if( can('all_chief_complaints') ){
        $chief_complaint = ChiefComplaint::select("id","name","is_active")->get();

        return DataTables::of($chief_complaint)
        ->rawColumns(['action', 'is_active'])
        ->editColumn('is_active', function (ChiefComplaint $chief_complaint) {
            if ($chief_complaint->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (ChiefComplaint $chief_complaint) {
            return '

                '.( can("edit_chief_complaint") ? '
                <button type="button" data-content="'.route('chief.complaints.edit.modal',$chief_complaint->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
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

//add_modal funciton start
public function add_modal(){
    if( can("add_chief_complaints") ){
        return view("backend.modules.test_module.all_cheif_complaints.modals.add");
    }
    else{
        return view("errors.404");
    }
}   
//add_modal funciton end

//add chief_complaint start
public function add(Request $request){

    if( can('add_chief_complaint') ){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:chief_complaints,name,',
        ]);
        

       if( $validator->fails() ){
           return response()->json(['errors' => $validator->errors()] ,422);
       }else{
            try{
                $chief_complaint = new ChiefComplaint();
                $chief_complaint->name = $request->name;
                $chief_complaint->is_active      = true;
                
                if( $chief_complaint->save() ){
                    return response()->json(['success' => 'New '.$chief_complaint->name.' Created Successfully'], 200);
                }

            }catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
            }
       }
    }else{
        return view("errors.404");
    }
}

//add chief_complaint end

//chief_complaint edit modal start
 public function edit_modal($id){
    if( can("edit_chief_complaint") ){
        $chief_complaint = ChiefComplaint::where("id",$id)->select("id","name","is_active")->first();
        return view("backend.modules.test_module.all_cheif_complaints.modals.edit", compact("chief_complaint"));
    }
    else{
        return view("errors.404");
    }
}
//chief_complaint edit modal end

//chief_complaint update modal start
public function update(Request $request, $id){
    if( can('edit_chief_complaint') ){
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:chief_complaints,name,'. $id,
       ]);

       if( $validator->fails() ){
           return response()->json(['errors' => $validator->errors()] ,422);
       }else{
            try{
                $chief_complaint = ChiefComplaint::find($id);
                $chief_complaint->name = $request->name;
                $chief_complaint->is_active      = $request->is_active;

                if( $chief_complaint->save() ){
                    return response()->json(['success' => $chief_complaint->name . "'s name Updated Successfully"], 200);
                }
            }catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
            }
       }
    }else{
        return view("errors.404");
    }
}

//chief_complaint update modal end



}
