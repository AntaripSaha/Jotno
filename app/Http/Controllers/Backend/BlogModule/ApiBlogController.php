<?php

namespace App\Http\Controllers\Backend\BlogModule;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogModule\BlogResourceCollection;
use App\Models\BlogModule\BlogModel;
use Illuminate\Http\Request;

class ApiBlogController extends Controller
{
    public function all_blog()
    {
        $blog_data = BlogModel::where("is_active", 1)->select('id', 'title', 'description', 'slug', 'image', 'created_by', 'is_active', 'type', 'created_at')->get();


        return response()->json([
            'status' => 'success',
            'body' => new BlogResourceCollection($blog_data)
        ], 200);
    }
}
