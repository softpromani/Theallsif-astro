<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;
use DataTables;
use Illuminate\Support\Facades\URL;

class SubscriptionController extends Controller
{
    public function subscription()
    {
        // return  $blogs = Blog::first()->images->first()->img;
        if (request()->ajax()) {
            $subscriptions = Subscription::latest()->get();
            return Datatables::of($subscriptions)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->subscriptionimages->first()->img ?? '';
                    $img .= '" alt="Avatar" class="rounded-circle" /></div>';
                    return $img;
                })
                ->addColumn('is_active', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '
                        <label class="switch switch-primary">
                        <input type="checkbox" class="switch-input is_active" data-id="' . $id . '"';
                    $ht .= ($row->is_active == 1) ? 'checked' : '';
                    $ht .= '>
                        <span class="switch-toggle-slider">
                          <span class="switch-on">
                            <i class="ti ti-check"></i>
                          </span>
                          <span class="switch-off">
                            <i class="ti ti-x"></i>
                          </span>
                        </span>
                      </label>';
                    return $ht;
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    if (Auth::user()->hasPermissionTo('subscription_edit')) {
                        $ht .= '<a href="' . route("admin.subscriptionEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('subscription_delete')) {
                        $ht .= ' <form action="' . route("admin.subscriptionDelete", $id) . '" method="post" style="display:inline">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                                <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                            </button>';
                    }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'imagemedia'])
                ->make(true);
        }

        return view('admin.subscription.subscription_list');
    }

    public function subscriptionStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'day' => 'required',
            'image' => 'image|required',
            'color' => 'required',
            'chat_min' => 'required',
            'call_min' => 'required',
            'price' => 'required',
        ]);

        try {

            $subscription = Subscription::create([
                'name' => $request->name,
                'day' => $request->day,
                'color' => $request->color,
                'chat_min' => $request->chat_min,
                'call_min' => $request->call_min,
                'price' => $request->price,
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = ImageHelper::uploadImage($file, 'subscription', 'subscription');
                $subscription->subscriptionimages()->create($image);
            }

            if ($subscription) {
                return redirect()->back()->with('success', 'Subscription Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Subscription not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function is_activeSubscription(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $subscription = Subscription::find($id)->is_active;
        if ($subscription == 1) {
            $update = Subscription::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Subscription::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function subscriptionEdit($id)
    {
        $id = Crypt::decrypt($id);
        if (request()->ajax()) {
            $subscriptions = Subscription::latest()->get();
            return Datatables::of($subscriptions)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->subscriptionimages->first()->img ?? '';
                    $img .= '" alt="Avatar" class="rounded-circle" /></div>';
                    return $img;
                })
                ->addColumn('is_active', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '
                        <label class="switch switch-primary">
                        <input type="checkbox" class="switch-input is_active" data-id="' . $id . '"';
                    $ht .= ($row->is_active == 1) ? 'checked' : '';
                    $ht .= '>
                        <span class="switch-toggle-slider">
                          <span class="switch-on">
                            <i class="ti ti-check"></i>
                          </span>
                          <span class="switch-off">
                            <i class="ti ti-x"></i>
                          </span>
                        </span>
                      </label>';
                    return $ht;
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    if (Auth::user()->hasPermissionTo('subscription_edit')) {
                        $ht .= '<a href="' . route("admin.subscriptionEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('subscription_delete')) {
                        $ht .= ' <form action="' . route("admin.subscriptionDelete", $id) . '" method="post" style="display:inline">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                                <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                            </button>';
                    }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'imagemedia'])
                ->make(true);
        }
        $edit = Subscription::find($id);
        return view('admin.subscription.subscription_edit', compact('edit'));
    }

    public function subscriptionUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'day' => 'required',
            'image' => 'image|nullable',
            'color' => 'required',
            'chat_min' => 'required',
            'call_min' => 'required',
            'price' => 'required',
        ]);

        try {
            $res = Subscription::find($id)->update([
                'name' => $request->name,
                'day' => $request->day,
                'color' => $request->color,
                'chat_min' => $request->chat_min,
                'call_min' => $request->call_min,
                'price' => $request->price,
            ]);

            if ($request->hasFile('image')) {
                $subscription = Subscription::find($id);
                $md = $subscription->subscriptionimages->first();
                $imagePath = $md->path . $md->image_name;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $file = $request->file('image');
                $image = ImageHelper::uploadImage($file, 'subscription', 'subscription');
                $subscription->subscriptionimages()->update($image);
            }

            if ($res) {
                return redirect()->back()->with('success', 'Subscription Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Subscription not Update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function subscriptionDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $subscription = Subscription::find($id);

            if (isset($subscription)) {
                $media = $subscription->subscriptionimages;
                if (isset($media)) {
                    foreach ($media as $md) {
                        $imagePath = $md->path . $md->image_name;
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                        $md->delete();
                    }
                }
                $subscription->delete();
                return redirect()->route('admin.subscription')->with('error', 'Subscription deleted successfully!');
            }
            return redirect()->back()->with('error', 'Subscription not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return  redirect()->back();
    }
}
