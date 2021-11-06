<?php

namespace App\Http\Controllers\Backend\ContactModule;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\ContactModule\ContactForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ContactController extends Controller
{
     //index funciton start
     public function index(){
        if( can("all_messege") ){
            return view("backend.modules.contact_module.all_messege");
        }
        else{
            return view("errors.404");
        }
    }   
    //index funciton end

     //view data
     public function data(){
        if( can('all_messege') ){
            $messege = ContactForm::select("id","name","email","subject","message","reply")->orderBy("id","desc")->get();

            return DataTables::of($messege)          
            
            ->addColumn('action', function (ContactForm $messege) {
                return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$messege->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown'.$messege->id.'">
                
                '.( can("reply_messege") ? '
                <a class="dropdown-item" href="#" data-content="'.route('messege.reply.view',$messege->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                    <i class="fas fa-edit"></i>
                    Reply Messege
                </a>
                ': '') .' 
                
                    '.( can("delete_messege") ? '
                    
                        <a class="dropdown-item text-danger" href="#" data-content="'.route('messege.delete.modal',$messege->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        Delete Messege
                    </a>
                    
                    ': '') .'

                    

                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
        
    }

      //reply_view funciton start
      public function reply_view($id){
         $messege = ContactForm::select("id","name","email","subject","message","reply")->where("id",$id)->first();
        if( can("reply_messege") ){
           
            return view("backend.modules.contact_module.modals.messege_reply_view" , compact("messege"));
        }
        else{
            return view("errors.404");
        }
    }   
    //reply_view funciton end

    // reply messege and send email to recipient start
    public function reply(Request $request, $id){
      $email = ContactForm::select("email")->where("id",$id)->first();
        if( can('reply_messege') ){
            
            $validator = Validator::make($request->all(),[
                'reply' => 'required',
           ]);

           if( $validator->fails() ){
               return response()->json(['errors' => $validator->errors()] ,422);
           }else{
                try{
                     $contact = ContactForm::find($id);
                     $contact->reply = $request->reply;

                    if( $contact->save() ){

                            $data = [
                                'reply'  => $request->reply,
                                'name'  => $contact->name
                                ]; 

                        $file = [
                            public_path('/frontend/img/logo-4.png'),
                        ];                 

                        Mail::to($email)->send(new \App\Mail\SendMail($data , $file));                            

                        return response()->json(['success' => 'Messege Replyed Successfully'], 200);
                    }
                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
           }
        }else{
            return view("errors.404");
        }
    }
    // reply messege and send email to recipient end

    //view delete modal
    public function delete_modal($id){
        if( can("delete_messege") ){
           $messege = ContactForm::where("id",$id)->first();
            return view("backend.modules.contact_module.modals.delete_messege", compact("messege"));
        }
        else{
            return view("errors.404");
        }
    }


   //messege delete function start    
    public function delete(Request $request , $id){
      
        $messege = ContactForm::find($id);
        if( can("delete_messege") ){
                $messege->delete();
            return response()->json(['success' => 'Messege Deleted Successfully'], 200);
        }
   }
   //messege delete function end
   
}

