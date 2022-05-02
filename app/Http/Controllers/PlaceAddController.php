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

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index(Request $request)
    {
        // dd($request->route('place'));
        $place = Place::find($request->route('id'));
        $user = User::find(Auth::id());
        $types = PlaceType::all();

        // dd($place);

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('new-place.index', [
                'place' => $place,
                'placeTypes' => $types
            ]);
        } else {
            abort(401);
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
}
