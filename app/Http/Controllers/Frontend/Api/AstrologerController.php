<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Astrologer;
use App\Models\Experties;
use App\Models\Faq;
use App\Models\Language;
use App\Models\RatingReview;
use App\Models\WebPage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AstrologerController extends Controller
{
    public function getExperties(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }

        try {
            $experty = Experties::get();

            return response()->json([
                'message' => 'Data Found Successfully !',
                'data' => $experty,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function getlanguages(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }

        try {
            $languages = Language::get();

            return response()->json([
                'message' => 'Data Found Successfully !',
                'data' => $languages,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function getAstrologerCount(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }
        try {
            $query = Astrologer::query();
            if (isset($query)) {
                $query->where('is_active', 1)->with('costs');
            }
            $astrologers = $query->get();
            return response()->json([
                'message' => 'Data Found Successfully !',
                'count' => $astrologers->count() ?? 0,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function getAstrologer(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }

        try {
            $query = Astrologer::query();
            if (isset($query)) {
                $query->where('is_active', 1)->with('costs');
            }

            if (isset($request->experties)) {
                $experties = $request->experties;
                $query->whereJsonContains('experties', $experties)->where('is_active', 1)->with('costs');
            }

            if (isset($request->language)) {
                $language = $request->language;
                $query->whereJsonContains('language', $language)->where('is_active', 1)->with('costs');
            }

            if (isset($request->type)) {

                if ($request->type == 'exp_h2l') {
                    $query->orderBy('experience', 'desc')->where('is_active', 1)->with('costs');
                }
                if ($request->type == 'n_a2z') {
                    $query->orderBy('first_name')->where('is_active', 1)->with('costs');
                }

                if ($request->type == 'p_h2l' || $request->type == 'p_l2h') {
                    if ($request->type == 'p_h2l') {
                        $sort = 'desc';
                    } else {
                        $sort = 'asc';
                    }
                    // $query->join('astrologer_costs', 'astrologer_costs.astrologer_id', '=', 'astrologers.id')
                    //     ->where('astrologers.is_active', 1)
                    //     ->orderBy('astrologer_costs.astrologer_cost', $sort)

                    // $astrologersAsc = Astrologer::join('astrologer_costs', 'astrologers.id', '=', 'astrologer_costs.astrologer_id')
                    //     ->where('astrologers.is_active', 1)
                    //     ->orderBy('astrologer_costs.astrologer_cost', $sort)
                    //     ->get();
                    $a = Astrologer::with('cost')->orderByDesc('costs.astrologer_cost')->get();
                    return $a;
                }
            }

            $astrologers = $query->get()->append('average_rating');
            return response()->json([
                'message' => 'Data Found Successfully !',
                'data' => $astrologers,
                'count' => $astrologers->count() ?? 0,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function astrologer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'astrologer_id' => 'required',
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
            $astrologers = Astrologer::where('id', $request->astrologer_id)->with('costs')->first()->append('average_rating');

            return response()->json([
                'message' => 'Data Found Successfully !',
                'data' => $astrologers,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function ratingReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'astrologer_id' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }

        try {
            $rating = RatingReview::updateOrCreate(
                [
                    'astrologer_id' => $request->astrologer_id,
                    'customer_id' => $user->id,
                ],
                [
                    'comment' => $request->comment,
                    'rating' => $request->rating,
                ]
            );

            return response()->json([
                'message' => 'Rating and Review Successfully !',
                'data' => $rating,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function webPage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }

        try {
            $webpage = WebPage::where('type', $request->type)->get();

            return response()->json([
                'message' => 'Data Found Successfully !',
                'data' => $webpage,
                'status' => true
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function faq()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }

        try {
            $faq = Faq::get();

            return response()->json([
                'message' => 'Data Found Successfully !',
                'data' => $faq,
                'status' => true
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
