<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function create(){
        $about = About::first();

        if ($about === null) {
            return view('admin.pages.about.create');

        }
        return redirect()->route('admin.about.edit', $about->id);
    }

    public function store(StoreAboutRequest $request){
    $about = About::first();
    if ($about) {
        return redirect()->route('admin.about.edit', $about->id);
    }

    $validatedData = $request->validated();
    if($request->hasFile('image')){
        $fileOrginialName = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
        $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/about'),  $fileName);
        $validatedData['image'] = $fileName;
    }
    $about = About::create($validatedData);


    $message = $about ? 'Thông tin đã được thêm thành công.' : '';
    return redirect()->route('admin.about.edit', $about->id)
        ->with('message', $message);
    }

    public function edit($id){
        $about = About::findOrFail($id);
        return view('admin.pages.about.edit', ['about' => $about]);
    }

    public function update(UpdateAboutRequest $request, $id){
        $validatedData = $request->validated();

        $about = About::findOrFail($id);
        $oldImageFileName = $about->image;

            if($request->hasFile('image')){
                $fileOrginialName = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
                $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('images/about'),  $fileName);
                $validatedData['image'] = $fileName;

                if(!is_null($oldImageFileName) && file_exists('images/about/'.$oldImageFileName)){
                    unlink('images/about/'.$oldImageFileName);
                }

            }

        $about->update($validatedData);

        $message = $about ? 'Thông tin đã được cập nhật thành công.' : 'Không có thông tin được cập nhật.';
        return redirect()
            ->route('admin.about.edit', $about->id)
            ->with('message', $message);
    }
}


