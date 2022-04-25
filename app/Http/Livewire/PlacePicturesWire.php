<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\PlacePicture;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlacePicturesWire extends Component
{
    use WithFileUploads;
    public $pictures = null;
    public $images;
    public $place_id;


    public function mount($pictures, $place_id)
    {
        $this->pictures = $pictures;
        $this->place_id = $place_id;
    }

    public function render()
    {
        return view('livewire.place-pictures-wire');
    }

    public function removeImage($index, $id)
    {
        $img = PlacePicture::find($id);
        if ($img->delete()) {
            Storage::disk('place-images')->delete($img->name);
            $this->pictures = $this->pictures->forget($index);
        }
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'mimes:png,jpg,jpeg,webp|max:12048',
        ]);

        if ($this->pictures->count() < 6) {
            foreach ($this->images as $image) {
                $img_name =  $this->place_id . '-' . Str::uuid() . '.' .  $image->extension();
                $img = $image->storeAs('', $img_name, 'place-images');
                $newImage = PlacePicture::create(['name' => $img_name, 'place_id' => $this->place_id, 'creator_id' => Auth::user()->id]);
                $newImage->save();
                $this->pictures->add($newImage);
            }
        }
    }
}
