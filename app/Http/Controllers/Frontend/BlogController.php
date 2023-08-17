<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BlogController extends Controller
{
    // public function commentStore(Request $request)
    // {
    //     $request->validate([
    //         'comments' => 'required',
    //         'blog_id' => 'required',
    //     ]);
    //     try {
    //         $blog = Blog::find(2);
    //         dd($blog);  
    //     } catch (Exception $ex) {
    //         $url = URL::current();
    //         Error::create(['url' => $url, 'message' => $ex->getMessage()]);
    //         return redirect()->back()->with('error', 'Server Error ');
    //     }
    // }
}
