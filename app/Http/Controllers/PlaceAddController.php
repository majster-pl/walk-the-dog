<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\PlaceType;
use Illuminate\Http\Request;
use App\Mail\PendingReviewToEditorsMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingReviewToUserMail;
use App\Mail\PlacePublishedToUserMail;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PlaceAddController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->route('place'));
        $place = Place::find($request->route('id'));
        $user = User::find(Auth::id());
        $types = PlaceType::all();

        // dd($place);

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('new-place.index', [
                'access' => true,
                'place' => $place,
                'placeTypes' => $types
            ]);
        } else {
            return view('edit-place.index', [
                'access' => false
            ]);
        }
    }

    public function add()
    {
        $user = Auth::user();
        // check if draft already exists, if so redirect to the same id to prevent from creating more drafts...
        $draft = Place::where('user_id', $user->id)->where(['status' => 'draft', 'title' => null])->get();
        if (count($draft) > 0) {
            return redirect('place/' . $draft[0]->id . '/add')->with(['success' => 'Continue with your draft']);
        } else {
            $place = $user->places()->create([
                'status' => 'draft',
            ]);
            return redirect('place/' . $place->id . '/add')->with(['success' => 'Draft created']);
        }
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        $place = Place::find($request->id);
        //get all request values and check status to assign correct status.
        $input = $request->all();

        $slug = SlugService::createSlug(Place::class, 'slug', $request->title);
        $input['slug'] = $place->slug === null ? $place->slug : $slug;

        $status = $place->status;
        if ($request->has('status')) {
            $input['status'] = "published";
        } else {
            $input['status'] = $place->status === "pending" ? "pending" : "unpublished";
        }

        $this->validate($request, [
            'title' => 'required|min:2',
            'main_image_path' => $request->has('main_image_path') ? 'required|mimes:png,jpg,jpeg,webp|max:5048' : 'nullable',
            'address_state_or_region' => 'required|min:3',
            'address_country' => 'required|min:3',
            'address_city' => 'required|min:3',
            'address_latitude' => 'required|min:15',
            'walk_time' => 'required',
            'parking' => 'required',
            'type_id' => 'required',
            'activity' => 'required',
            'dogs_only' => 'required',
            'seasonal_access' => 'required',
            'off_lead' => 'required',
            'cafe_access' => 'required',
            'activity' => 'required',
            'access_to_water' => 'required',
            'disposal_bins' => 'required',
            'description' => 'required|min:10'
        ]);

        //if new photo selected, remove old photo and upload new one.
        if ($request->has('main_image_path')) {
            $newImageName = 'main_photo-' . $slug . '-' . $request->id . '.' . $request->main_image_path->extension();
            if (File::exists(public_path('uploads/images/' . $place->main_image_path))) {
                File::delete(public_path('uploads/images/' . $place->main_image_path));
            }
            $request->main_image_path->move(public_path('uploads/images'), $newImageName);
            $input['main_image_path'] = $newImageName;
        }


        // if editor or admin, allow to publish otherwise change status to pending.
        if ($user->hasRole('editor|super-user')) {
            $update = $place->update($input);
            if (!$update) {
                return redirect()->back()->with('error', 'There was problem adding new place... Please try again.');
            } else {
                if ($status == 'pending') {
                    Mail::to($place->user->email)->send(new PlacePublishedToUserMail($place, $user));
                }
                return redirect('place/' . $request->id)->with('success', 'Place added successfully!');
            }
        } else if ($place->user->id === Auth::id()) {
            $input['status'] = "pending";
            $update = $place->update($input);
            if (!$update) {
                return redirect('new-place-confirmation')->with('error', 'There was problem updating place... Please try again later!');
            } else {
                $place = Place::find($request->id);
                $writers = User::role('editor')->get('email');
                Mail::to($writers)->send(new PendingReviewToEditorsMail($place, $user));
                Mail::to($place->user->email)->send(new PendingReviewToUserMail($place, $place->user));
                return redirect('new-place-confirmation')->with('success_', true);
            }
        } else {
            abort(403);
        }

    }
}