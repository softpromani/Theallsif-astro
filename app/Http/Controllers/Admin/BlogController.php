<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Error;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Helpers\ImageHelper;
use App\Models\AstrologerCost;
use App\Models\Category;
use App\Models\Event;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function blog()
    {
        // return  $blogs = Blog::first()->images->first()->img;
        if (request()->ajax()) {
            $blogs = Blog::latest()->get();
            return Datatables::of($blogs)
                ->addIndexColumn()
                ->addColumn('description', function ($row) {
                    $ht = '';
                    $ht .= $row->description;
                    return $ht;
                })
                ->addColumn('category_id', function ($row) {
                    $ht = '';
                    $ht .= $row->category->category;
                    return $ht;
                })
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->images->first()->img ?? '';
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
                    $ht .= '<a href="' . route("admin.imageShow", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-image"></i></a>';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a href="' . route("admin.blogEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.blogDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'description', 'imagemedia', 'category_id'])
                ->make(true);
        }

        return view('admin.blog.blog_list');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'meta_tag' => 'nullable',
            'meta_name' => 'nullable',
            'meta_keyword' => 'nullable',
            'date_time' => 'required',
            // 'image' => 'image|nullable',
            'description' => 'required',
            'category' => 'required',
        ]);
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'meta_tag' => $request->meta_tag ?? null,
                'meta_name' => $request->meta_name ?? null,
                'meta_keyword' => $request->meta_keyword ?? null,
                'date_time' => $request->date_time,
                'description' => $request->description,
                'category_id' => $request->category,
            ]);
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    $image = ImageHelper::uploadImage($file, 'blog', 'blog');
                    $blog->images()->create($image);
                }
            }

            if ($blog) {
                return redirect()->back()->with('success', 'Blog Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Blog not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function is_activeBlog(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $blog = Blog::find($id)->is_active;
        if ($blog == 1) {
            $update = Blog::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Blog::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function blogEdit($id)
    {
        $id = Crypt::decrypt($id);
        if (request()->ajax()) {
            $blogs = Blog::latest()->get();
            return Datatables::of($blogs)
                ->addIndexColumn()
                ->addColumn('description', function ($row) {
                    $ht = '';
                    $ht .= $row->description;
                    return $ht;
                })
                ->addColumn('category_id', function ($row) {
                    $ht = '';
                    $ht .= $row->category->category;
                    return $ht;
                })
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->images->first()->img;
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
                    $ht .= '<a href="' . route("admin.imageShow", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-image"></i></a>';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a href="' . route("admin.blogEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.blogDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'description', 'imagemedia', 'category_id'])
                ->make(true);
        }
        $edit = Blog::find($id);
        return view('admin.blog.blog_edit', compact('edit'));
    }

    public function blogUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'meta_tag' => 'nullable',
            'meta_name' => 'nullable',
            'meta_keyword' => 'nullable',
            'date_time' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        try {
            $res = Blog::find($id)->update([
                'title' => $request->title,
                'meta_tag' => $request->meta_tag ?? null,
                'meta_name' => $request->meta_name ?? null,
                'meta_keyword' => $request->meta_keyword ?? null,
                'date_time' => $request->date_time,
                'description' => $request->description,
                'category_id' => $request->category,
            ]);
            if ($res) {
                return redirect()->back()->with('success', 'Blog Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Blog not Update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function blogDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $blog = Blog::find($id);

            if (isset($blog)) {
                $media = $blog->images;
                if (isset($media)) {
                    foreach ($media as $md) {
                        $imagePath = $md->path . $md->image_name;
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                        $md->delete();
                    }
                }
                $blog->delete();
                return redirect()->route('admin.blog')->with('danger', 'Blog deleted successfully!');
            }
            return redirect()->back()->with('error', 'Blog not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }

    public function imageShow($id)
    {
        $deid = Crypt::decrypt($id);
        if (request()->ajax()) {
            $blog = Blog::find($deid);
            return Datatables::of($blog->images)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->img;
                    $img .= '" alt="Avatar" class="rounded-circle" /></div>';
                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a  class="btn btn-link p-0 image_edit "style="display:inline" data-id="' . $id . '"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.imageDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })

                ->rawColumns(['action', 'imagemedia'])
                ->make(true);
        }
        return view('admin.blog.image_list', compact('id', 'deid'));
    }

    public function imageEdit($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $media = Media::find($id);
            $view = '';
            $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                    <input type="text" class="form-control" id="media_id" name="media_id" value="' . $media->id . '"/>
                        <label for="imageable_id" class="form-label">Imageable Id</label>
                        <input type="text" class="form-control" id="imageable_id" name="imageable_id" value="' . $media->imageable_id . '"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-2"> <img src="' . $media->img . '" alt="" srcset="" height="50px" width="50px"></div>
                    <div class="col-10">
                        <div class="mb-3">
                         <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
       ';

            return $view;
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function imageUpdate(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $media = Media::find($request->media_id);
                if ($media) {
                    $imagePath = $media->path . $media->image_name;
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
                $image = ImageHelper::uploadImage($file, 'blog', 'blog');
                $media->update($image);
                $id = Crypt::encrypt($request->imageable_id);
                return redirect()->route('admin.imageShow', $id)->with('success', 'Image Update successfully!');
            }
            $id = Crypt::encrypt($request->imageable_id);
            return redirect()->route('admin.imageShow', $id)->with('error', 'Image Not Update successfully!');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function imageDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $media = Media::find($id);
            if ($media) {
                $imagePath = $media->path . $media->image_name;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $media->delete();
                return redirect()->route('admin.blog')->with('danger', 'Image deleted successfully!');
            }
            return redirect()->back()->with('error', 'Image not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }


    public function event()
    {
        // return  $blogs = Blog::first()->images->first()->img;
        if (request()->ajax()) {
            $events = Event::latest()->get();
            return Datatables::of($events)
                ->addIndexColumn()
                ->addColumn('description', function ($row) {
                    $ht = '';
                    $ht .= $row->description;
                    return $ht;
                })
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->images->first()->img ?? '';
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
                    $ht .= '<a href="' . route("admin.imageeventShow", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-image"></i></a>';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a href="' . route("admin.eventEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.eventDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'description', 'imagemedia'])
                ->make(true);
        }

        return view('admin.event.event_list');
    }

    public function eventStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'meta_tag' => 'nullable',
            'meta_name' => 'nullable',
            'meta_keyword' => 'nullable',
            'date_time' => 'required',
            // 'image' => 'image|nullable',
            'description' => 'required',
        ]);

        try {
            $event = Event::create([
                'title' => $request->title,
                'meta_tag' => $request->meta_tag ?? null,
                'meta_name' => $request->meta_name ?? null,
                'meta_keyword' => $request->meta_keyword ?? null,
                'date_time' => $request->date_time,
                'description' => $request->description,
                // 'image' => $ImageNames,
            ]);
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    $image = ImageHelper::uploadImage($file, 'event', 'event');
                    $event->images()->create($image);
                }
            }

            if ($event) {
                return redirect()->back()->with('success', 'Event Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Event not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function is_activeEvent(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $event = Event::find($id)->is_active;
        if ($event == 1) {
            $update = Event::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Event::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function eventEdit($id)
    {
        $id = Crypt::decrypt($id);
        if (request()->ajax()) {
            $events = Event::latest()->get();
            return Datatables::of($events)
                ->addIndexColumn()
                ->addColumn('description', function ($row) {
                    $ht = '';
                    $ht .= $row->description;
                    return $ht;
                })
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->images->first()->img;
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
                    $ht .= '<a href="' . route("admin.imageeventShow", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-image"></i></a>';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a href="' . route("admin.eventEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.eventDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'description', 'imagemedia'])
                ->make(true);
        }
        $edit = Event::find($id);
        return view('admin.event.event_edit', compact('edit'));
    }


    public function eventUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'meta_tag' => 'nullable',
            'meta_name' => 'nullable',
            'meta_keyword' => 'nullable',
            'date_time' => 'required',
            'description' => 'required',
        ]);

        try {
            $res = Event::find($id)->update([
                'title' => $request->title,
                'meta_tag' => $request->meta_tag ?? null,
                'meta_name' => $request->meta_name ?? null,
                'meta_keyword' => $request->meta_keyword ?? null,
                'date_time' => $request->date_time,
                'description' => $request->description,
            ]);
            if ($res) {
                return redirect()->back()->with('success', 'Event Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Event not Update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function eventDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $event = Event::find($id);

            if (isset($event)) {
                $media = $event->images;
                if (isset($media)) {
                    foreach ($media as $md) {
                        $imagePath = $md->path . $md->image_name;
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                        $md->delete();
                    }
                }
                $event->delete();
                return redirect()->route('admin.event')->with('danger', 'Event deleted successfully!');
            }
            return redirect()->back()->with('error', 'Event not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }


    public function imageeventShow($id)
    {
        $deid = Crypt::decrypt($id);
        if (request()->ajax()) {
            $event = Event::find($deid);
            return Datatables::of($event->images)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->img;
                    $img .= '" alt="Avatar" class="rounded-circle" /></div>';
                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a  class="btn btn-link p-0 image_edit "style="display:inline" data-id="' . $id . '"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.imageeventDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })

                ->rawColumns(['action', 'imagemedia'])
                ->make(true);
        }
        return view('admin.event.img_list', compact('id', 'deid'));
    }

    public function imageeventEdit($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $media = Media::find($id);
            $view = '';
            $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                    <input type="text" class="form-control" id="media_id" name="media_id" value="' . $media->id . '"/>
                        <label for="imageable_id" class="form-label">Imageable Id</label>
                        <input type="text" class="form-control" id="imageable_id" name="imageable_id" value="' . $media->imageable_id . '"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-2"> <img src="' . $media->img . '" alt="" srcset="" height="50px" width="50px"></div>
                    <div class="col-10">
                        <div class="mb-3">
                         <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
       ';

            return $view;
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function imageeventUpdate(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $media = Media::find($request->media_id);
                if ($media) {
                    $imagePath = $media->path . $media->image_name;
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
                $image = ImageHelper::uploadImage($file, 'event', 'event');
                $media->update($image);
                $id = Crypt::encrypt($request->imageable_id);
                return redirect()->route('admin.imageeventShow', $id)->with('success', 'Image Update successfully!');
            }
            $id = Crypt::encrypt($request->imageable_id);
            return redirect()->route('admin.imageeventShow', $id)->with('error', 'Image Not Update successfully!');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function imageeventDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $media = Media::find($id);
            if ($media) {
                $imagePath = $media->path . $media->image_name;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $media->delete();
                return redirect()->route('admin.event')->with('danger', 'Image deleted successfully!');
            }
            return redirect()->back()->with('error', 'Image not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }

    public function category()
    {
        if (request()->ajax()) {
            $categores = Category::latest()->get();
            return Datatables::of($categores)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    // if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                    $ht .= '<a href="' . route("admin.categoryEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    // }
                    // if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                    $ht .= ' <form action="' . route("admin.categoryDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    // }
                    return $ht;
                })
                // 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.blog.category_list');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);
        try {
            $category = Category::create([
                'category' => $request->category,
            ]);
            if ($category) {
                return redirect()->back()->with('success', 'Category Added Successfully !');
            }
            return redirect()->back()->with('danger', 'Category Not Add Successfully !');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function categoryEdit($id)
    {
        $id = Crypt::decrypt($id);
        $category = Category::find($id);
        return view('admin.blog.category_edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
        ]);
        try {
            $category = Category::find($id)->update([
                'category' => $request->category,
            ]);
            if ($category) {
                return redirect()->back()->with('success', 'Category Updated Successfully !');
            }
            return redirect()->back()->with('danger', 'Category Not Update!');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function categoryDelete($id)
    {
        $id = Crypt::decrypt($id);

        try {
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                return redirect()->back()->with('error', 'Category deleted Successfully !');
            }
            return redirect()->back()->with('error', 'Category Not delete!');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }
}
