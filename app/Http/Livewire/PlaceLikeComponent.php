<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PlaceLikeComponent extends Component
{
    public $like;
    public $likes;
    public $place;
    
    public function mount($place)
    {
        $this->like = $place->likedBy(Auth::user());
        $this->likes = $place->likes->count();
        $this->place = $place;
    }
    
    
    public function render()
    {
        return view('livewire.place-like-component');
    }

    public function likePlace()
    {
        //check if user auth
        if (Auth::check()) {
            $query = false;
            $place_ = Place::where('id', $this->place->id)->get()->first();
            // if liked by user, remove from table
            if ($place_->likedBy(Auth::user())) {
                $query = $this->place->likes()->where('place_id', $this->place->id)->delete();
            } else {
                $query = $this->place->likes()->create([
                    'user_id' => Auth::user()->id,
                ]);
            }
            // if query true
            $place_ = Place::where('id', $this->place->id)->get()->first();
            if ($query) {
                $this->like = $place_->likedBy(Auth::user());
                $this->likes = $place_->likes->count();
            }
        } else {
            redirect('/login');
        }
    }
}
