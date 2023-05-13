<?php

namespace App\Http\Livewire;

use App\Models\Image as ModelsImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Image extends Component
{
    use WithFileUploads;
    public $showingImageModal =  false;
    public $image;
    public $oldImage;
    public $description;
    public $slug;
    public $title;
    public $isEditMode = false;
    public $imagin;
    public function render()
    {
        return view('livewire.image')->with([
            'imgs' => ModelsImage::all()
        ]);
    }
    public function showImageModal() // show modal
    {
        $this->reset();
        $this->showingImageModal = true;
    }
    public function index () {
        return view('dashboard');
    }
    public function storeImage () { // store image
        $data = $this->validate([
            'image' => 'image|required',
            'title' => 'required|unique:images,title',
            'description' => 'nullable|max:255',
        ],[
            'image.image' => 'Image must be an image',
            'image.required' => 'Image is required',
            'title.required' => 'Title is required',
            'title.unique' => 'Title already exists',
            'description.max' => 'Description must be less than 255 characters'
        ]);
        $this->image->storeAs('/public/images', time() . '_' . $this->image->getClientOriginalName());
        ModelsImage::create([
            'image_name' => time() . '_' . $this->image->getClientOriginalName(),
            'description' => $data['description'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
        ]);
        $this->reset();
        $this->deleteLivewireTmpFiles();
    }
    private function deleteLivewireTmpFiles() // delete storage/app/livewire-tmp
    {
        $livewireTmpPath = storage_path('app/livewire-tmp');
        if (File::exists($livewireTmpPath)) {
            File::deleteDirectory($livewireTmpPath);
        }
    }
    public function showEditImageModal($id) { // show edit image modal
        $this->imagin = ModelsImage::findOrFail($id);
        $this->title = $this->imagin->title;
        $this->oldImage = $this->imagin->image_name;
        $this->description = $this->imagin->description;
        $this->showingImageModal = true;
        $this->isEditMode = true;
    }
    public function updateImage () { // update image
        $this->validate([
            'image' => 'image|nullable',
            'title' => 'required',
            'description' => 'nullable|max:255',
        ],[
            'image.image' => 'Image must be an image',
            'title' => 'Title is required',
            'description.max' => 'Description must be less than 255 characters'
        ]);
        $img = $this->imagin->image_name;
        if ($this->image) {
            $this->image->storeAs('/public/images/', time() . '_' . $this->image->getClientOriginalName());
            $img = time() .'_' . $this->image->getClientOriginalName();
            Storage::delete('/public/images/' . $this->oldImage);
        }
        $this->imagin->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'image_name' => $img,
            'description' => $this->description,
        ]);
        $this->reset();
        $this->deleteLivewireTmpFiles();
    }
    public function deleteImage($id) { // delete image
        $img = ModelsImage::findOrFail($id);
        Storage::delete('/public/images/' . $img->image_name);
        $img->delete();
        $this->reset();
    }
}
