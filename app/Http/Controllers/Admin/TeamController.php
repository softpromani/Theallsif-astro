<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Team;
use Illuminate\Http\Request;
use Exception;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class TeamController extends Controller
{

    public function teams()
    {
        // return  $blogs = Blog::first()->images->first()->img;
        if (request()->ajax()) {
            $teams = Team::latest()->get();
            return Datatables::of($teams)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->teamimages->first()->img ?? '';
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
                    if (Auth::user()->hasPermissionTo('team_edit')) {
                        $ht .= '<a href="' . route("admin.teamEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('team_delete')) {
                        $ht .= ' <form action="' . route("admin.teamDelete", $id) . '" method="post" style="display:inline">
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

        return view('admin.team.team_list');
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'introduction' => 'required',
            'image' => 'image|required',
        ]);

        try {

            $team = Team::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'introduction' => $request->introduction,
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = ImageHelper::uploadImage($file, 'team', 'team');
                $team->teamimages()->create($image);
            }

            if ($team) {
                return redirect()->back()->with('success', 'Team Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Team not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function is_activeTeam(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $team = Team::find($id)->is_active;
        if ($team == 1) {
            $update = Team::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Team::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function teamEdit($id)
    {
        $id = Crypt::decrypt($id);
        if (request()->ajax()) {
            $teams = Team::latest()->get();
            return Datatables::of($teams)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->teamimages->first()->img ?? '';
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
                    if (Auth::user()->hasPermissionTo('team_edit')) {
                        $ht .= '<a href="' . route("admin.teamEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('team_delete')) {
                        $ht .= ' <form action="' . route("admin.teamDelete", $id) . '" method="post" style="display:inline">
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
        $edit = Team::find($id);
        return view('admin.team.team_edit', compact('edit'));
    }

    public function teamUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'introduction' => 'required',
            'image' => 'image|nullable',
        ]);

        try {
            $res = Team::find($id)->update([
                'name' => $request->name,
                'designation' => $request->designation,
                'introduction' => $request->introduction,
            ]);

            if ($request->hasFile('image')) {
                $team = Team::find($id);
                $md = $team->teamimages->first();
                $imagePath = $md->path . $md->image_name;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $file = $request->file('image');
                $image = ImageHelper::uploadImage($file, 'team', 'team');
                $team->teamimages()->update($image);
            }

            if ($res) {
                return redirect()->back()->with('success', 'Team Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Team not Update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function teamDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $team = Team::find($id);

            if (isset($team)) {
                $media = $team->teamimages;
                if (isset($media)) {
                    foreach ($media as $md) {
                        $imagePath = $md->path . $md->image_name;
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                        $md->delete();
                    }
                }
                $team->delete();
                return redirect()->route('admin.teams')->with('error', 'Team deleted successfully!');
            }
            return redirect()->back()->with('error', 'Team not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }
}
