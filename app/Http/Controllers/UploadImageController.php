<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;

class UploadImageController extends Controller
{
    public function form()
    {
        return view('upload_image', [
            'title' => 'Upload Image',
        ]);
    }

    public function upload(UploadImageRequest $request)
    {
        $data = $request->validated();

        // dd($data['image'], $request->file('image'));
        $name = $data['image']->getClientOriginalName();

        $extension = $data['image']->getClientOriginalExtension();

        $extensionByMime = $data['image']->extension();

        $hashed_name = $data['image']->hashName();

        dd($name, $extension, $extensionByMime, $hashed_name);

        // $path = $data['image']->storeAs('images', auth()->user()->id . '.' . $extension, 'public');

        $path = $data['image']->store('images', 'public');

        return back()->with('success', "Image file has been uploaded with path: {$path}");
    }
}
