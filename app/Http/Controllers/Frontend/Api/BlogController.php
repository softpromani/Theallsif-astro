<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function commentStore(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'blog_id' => 'required',
            'comments' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }
        try {
            $user = Auth::guard('sanctum')->user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'status' => false,
                    'error' => null
                ], 401);
            }

            $blog = Blog::find($request->blog_id);
            $blog->comments()->create([
                'comments' => $request->comments,
                'comment_id' => $user->id,
            ]);
            return response()->json([
                'message' => 'Comment Added Successfully !',
                'data' => Blog::with('comments')->find($request->blog_id),
                'status' => true,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }
}
