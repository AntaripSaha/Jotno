<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactModule\ContactForm;
use App\Models\HomeModule\Home;
use App\Models\ServiceModule\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BlogModule\BlogModel;
use App\Models\UserModule\User;
use App\Models\UserModule\SuperAdmin;

class FrontendController extends Controller
{
    //contact us page start
    public function contact()
    {
        return view("frontend.pages.contact");
    }
    //contact us page end

    //---------------All Blog Pages Start------------------//


    //Blog page start
    public function blog()
    {
        $blogs = BlogModel::where('is_active', 1)
            ->select('created_at', 'created_by', 'id', 'description', 'title', 'image', 'type', 'slug')
            ->latest()
            ->paginate(4);

        $latest_blog = BlogModel::where('is_active', 1)
            ->select('created_at', 'created_by', 'title', 'id', 'image', 'slug')
            ->latest()
            ->limit(4)
            ->get();

        return view("frontend.pages.blogs.blog", compact('blogs', 'latest_blog'));
    }
    //Blog page end

    //Blog Details page start
    public function blogDetails($slug)
    {
        $blogs = BlogModel::where('slug', $slug)
            ->select('created_at', 'created_by', 'id', 'description', 'title', 'image', 'type')
            ->first();

        $latest_blog = BlogModel::select('created_at', 'created_by', 'id', 'title', 'image', 'slug')
            ->latest()
            ->limit(4)
            ->get();

        return view("frontend.pages.blogs.blog-details", compact('blogs', 'latest_blog'));
    }
    //Blog Details page end

    //Blog Search page start
    public function search(Request $request)
    {

        $var = $request->data;
        $blogs = BlogModel::where('title', 'LIKE', '%' . $var . '%')
            ->orWhere('description', 'LIKE', '%' . $var . '%')
            ->select('created_at', 'created_by', 'id', 'description', 'title', 'image', 'type', 'slug')
            ->paginate(5);

        $latest_blog = BlogModel::select('created_at', 'created_by', 'title', 'id', 'image', 'slug')
            ->latest()
            ->limit(4)
            ->get();

        return view("frontend.pages.blogs.search", compact('blogs', 'latest_blog', 'var'));
    }
    //Blog Search page end


    //-----------------All Blog Pages Start-------------------//


    //about us page start
    public function about()
    {
        $aboutDatas = Home::select("about_title", "about_description", "about_image", "satisfied_patient", "patient_per_year")->first();

        if ($aboutDatas) {
            return view("frontend.pages.about", compact('aboutDatas'));
        } else {
            return view("errors.404");
        }
    }
    //about us page end

    // service function start
    public function services(){

        $servicesData = Service::select("id","name","image","position",)->where("is_active", true)->orderBy("position","asc")->paginate(20);
         
        if( $servicesData ){
            return view("frontend.pages.services",compact('servicesData'));
        }else{
            return view("errors.404");
        }
    }
    // service function end

    //send message from contact form start
    public function contact_sms_send(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required|numeric|regex:/(01)[0-9]{9}/",
                "subject" => "required",
                "message" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                $contact_form = new ContactForm();
                $contact_form->name = $request->name;
                $contact_form->email = $request->email;
                $contact_form->phone = $request->phone;
                $contact_form->subject = $request->subject;
                $contact_form->message = $request->message;

                if ($contact_form->save()) {
                    return response()->json(['success' => 'Thanks for messaging us. We will contact with you soon'], 200);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
    //send message from contact form end

}
