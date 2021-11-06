<?php

namespace App\Http\Controllers\Backend\BlogModule;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SuperAdmin as MiddlewareSuperAdmin;
use Illuminate\Http\Request;
use App\Models\BlogModule\BlogModel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\UserModule\SuperAdmin;
use App\Models\UserModule\User;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    //index function start
    public function index()
    {
        if (can("all_blog")) {
            return view('backend.modules.page_module.blog.index');
        } else {
            return view("errors.404");
        }
    }
    //index function end

    public function data()
    {
        if (can('all_blog')) {
            $data = BlogModel::All();

            return DataTables::of($data)
                ->rawColumns(['action', 'image', 'is_active', 'description', 'created_by'])
                ->editColumn('description', function (BlogModel $blog) {
                    return Str::limit($blog->description, 20);
                })
                ->editColumn('created_by', function (BlogModel $blog) {
                    if ($blog->type == 'user') {
                        return $name = User::where('id', $blog->created_by)->pluck('name')->first();
                    } elseif ($blog->type == 'super_admin') {
                        return  $name = SuperAdmin::where('id', $blog->created_by)->pluck('name')->first();
                    }
                })
                ->editColumn('is_active', function (BlogModel $blog) {

                    if ($blog->is_active == true) {
                        return '<p class="badge badge-success">Active</p>';
                    } else {
                        return '<p class="badge badge-danger">Inactive</p>';
                    }
                })
                ->editColumn('image', function (BlogModel $blog) {
                    if ($blog->image == null) {
                        $src = asset("images/user.png");
                    } else {
                        $src = asset("images/blogs/" . $blog->image);
                    }
                    return
                        "<img src='$src' width='50px' style='border-radius: 100%'>";
                })

                ->addColumn('action', function (BlogModel $blog) {
                    return '
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown' . $blog->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown' . $blog->id . '">

                  ' . (can("view_blog") ? '
                <a class="dropdown-item" href="#" data-content="' . route('blog.view.modal', $blog->id) . '" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                    <i class="fas fa-eye"></i>
                    View Blog
                </a>
                ' : '') . '
                
                ' . (can("edit_blog") ? '
                <a class="dropdown-item" href="#" data-content="' . route('blog.edit', $blog->id) . '" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                    <i class="fas fa-edit"></i>
                    Edit Blog
                </a>
                ' : '') . ' 
                
                    ' . (can("delete_blog") ? '
                    <a class="dropdown-item text-danger" href="#" data-content="' . route('blog.delete.modal', $blog->id) . '" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        Delete Blog
                    </a>
                    ' : '') . '
                    

                ';
                })
                ->make(true);
        } else {
            return view("errors.404");
        }


        // return view('backend.modules.page_module.blog.index', compact('data'));
    }


    //add_modal funciton start
    public function add_modal()
    {
        if (can("add_blog")) {
            return view("backend.modules.page_module.blog.modals.add");
        } else {
            return view("errors.404");
        }
    }
    //add_modal funciton end

    //add blog start
    public function add(Request $request)
    {

        if (can('add_blog')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required | unique:blog_models,title',
                'description' => 'required',
                'image' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                try {
                    $blog = new BlogModel();

                    if (Auth::guard('super_admin')->check()) {
                        $blog->type = 'super_admin';
                        $blog->created_by = Auth::guard('super_admin')->user()->id;
                    } elseif (Auth::guard('web')->check()) {
                        $blog->type = 'user';
                        $blog->created_by = Auth::guard('web')->user()->id;
                    }
                    $blog->is_active = true;
                    $blog->title = $request->title;
                    $blog->description = $request->description;
                    $blog->slug = Str::slug($request->title);
                    // image insert 
                    if ($request->image) {

                        //insert that image
                        $image = $request->file('image');
                        $img = time() . Str::random(12) . '.' . $image->getClientOriginalExtension();
                        $location = public_path('images/blogs/' . $img);
                        Image::make($image)->save($location);
                        $blog->image = $img;
                    }


                    if ($blog->save()) {
                        return response()->json(['success' => 'Blog Created Successfully'], 200);
                    }
                } catch (Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }
        } else {
            return view("errors.404");
        }
    }

    //add blog end


    //add_modal funciton start
    public function edit($id)
    {
        $blog = BlogModel::find($id);

        if (can("edit_blog")) {
            return view("backend.modules.page_module.blog.modals.edit", compact('blog'));
        } else {
            return view("errors.404");
        }
    }
    //add_modal funciton end

    //add blog start
    public function update(Request $request, $id)
    {
        if (can('edit_blog')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:blog_models,title,' . $id,
                'description' => 'required',
            ]);



            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                try {
                    $blog = BlogModel::find($id);
                    $blog->title = $request->title;
                    $blog->is_active = $request->is_active;
                    $blog->description = $request->description;
                    $blog->slug = Str::slug($request->title);

                    // image insert 
                    if ($request->image) {

                        //insert that image
                        if (File::exists('images/blogs/' . $blog->image)) {
                            File::delete('images/blogs/' . $blog->image);
                        }
                        $image = $request->file('image');
                        $img = time() . Str::random(12) . '.' . $image->getClientOriginalExtension();
                        $location = public_path('images/blogs/' . $img);
                        Image::make($image)->save($location);
                        $blog->image = $img;
                    }
                    if ($blog->save()) {
                        return response()->json(['success' => 'Blog Updated Successfully'], 200);
                    }
                } catch (Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }
        } else {
            return view("errors.404");
        }
    }

    //add blog end



    //view delete modal
    public function delete_modal($id)
    {
        $blog = BlogModel::where("id", $id)->first();
        if (can("delete_blog")) {
            return view("backend.modules.page_module.blog.modals.delete_modal", compact('blog'));
        } else {
            return view("errors.404");
        }
    }


    //blog delete function start    
    public function delete($id)
    {

        $blog = BlogModel::find($id);
        if (can("delete_blog")) {

            if (File::exists('images/blogs/' . $blog->image)) {
                File::delete('images/blogs/' . $blog->image);
            }
            $blog->delete();
            return response()->json(['success' => 'Deleted Successfully'], 200);
        }
    }

    public function view_modal($id)
    {
        $blog = BlogModel::find($id);
        return view("backend.modules.page_module.blog.modals.view", compact('blog'));
    }
}
