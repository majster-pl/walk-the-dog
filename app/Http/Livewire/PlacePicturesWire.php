<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PlacePicture;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class PlacePicturesWire extends Component
{
    use WithFileUploads;
    public $pictures = [];
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
        $img->delete();
        $this->pictures = $this->pictures->forget($index);
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'mimes:png,jpg,jpeg,webp|max:12048',
        ]);

        foreach ($this->images as $index => $image) {
            $img_name =  $this->place_id . '-' . time() . '_' . $index . '.' .  $image->extension();
            $img = $image->storeAs('uploads/images', $img_name, 'public');
            // dd($img);
            $newImage = PlacePicture::create(['name' => $img_name, 'place_id' => $this->place_id, 'creator_id' => Auth::user()->id]);
            $newImage->save();

            $this->pictures = $this->pictures->add($newImage);
        }
    }
}
