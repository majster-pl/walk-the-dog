<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\PlaceType;
use Illuminate\Http\Request;
use App\Mail\PendingReviewMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingReviewToUserMail;
use App\Mail\PlacePublishedToUserMail;
use Spatie\Permission\Traits\HasRoles;
use App\Mail\PendingReviewToEditorsMail;
use App\Mail\PendingEditReviewToUserMail;
use App\Mail\PendingEditReviewToEditorsMail;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PlaceEditController extends Controller
{
    use HasRoles;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index(Request $request)
    {
        $place = Place::where("id", $request->route('place'))->orWhere('slug', $request->route('place'))->get()->first();
        $user = User::find(Auth::id());
        $types = PlaceType::all();

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('edit-place.index', [
                'access' => true,
                'place' => $place,
                'placeTypes' => $types
            ]);
        } else {
            return view('edit-place.index', [
                'access' => false,
                'place' => $place,
            ]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::find(Auth::id());
        $place = Place::find($request->id);
        //get all request values and check status to assign correct status.
        $input = $request->all();

        
        $input['slug'] = $place['slug'] ?? SlugService::createSlug(Place::class, 'slug', $request->title);
 
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
                return redirect()->back()->with('error', 'There was problem updating place... Please try again later!');
            } else {
                if ($status == 'pending') {
                    Mail::to($place->user->email)->send(new PlacePublishedToUserMail($place, $place->user));
                    return redirect('place/' . $input['slug'])->with('success', 'Place published successfully!');
                }
                return redirect('place/' . $input['slug'])->with('success', 'Place updated successfully!');
            }
        } else if ($place->user->id === Auth::id()) {
            $input['status'] = "pending";
            $update = $place->update($input);
            if (!$update) {
                return redirect()->back()->with('error', 'There was problem updating place... Please try again later!');
            } else {
                $place = Place::find($request->id);
                $writers = User::role('editor')->get('email');
                
                if ($status == 'draft') {
                    // dd('new place...');
                    Mail::to($writers)->send(new PendingReviewToEditorsMail($place, $user));
                    Mail::to($place->user->email)->send(new PendingReviewToUserMail($place, $place->user));
                    return redirect('new-place-confirmation')->with(['warning' => 'Your place is currently awaiting moderator review...', 'success_' => true]);
                } else {
                    // dd('EDIT PLACE...');
                    Mail::to($writers)->send(new PendingEditReviewToEditorsMail($place, $user));
                    Mail::to($place->user->email)->send(new PendingEditReviewToUserMail($place, $place->user));
                    return redirect(route('place.preview', $place->slug))->with(['warning' => 'Thank you for taking your time to improve details for this place!<br>Your request is currently awaiting editor review, we\'ll drop you an email when it\'s published.']);
                }
            }
        } else {
            abort(403);
        }
    }
}
