<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use App\Models\Information;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller{
    public function create(){
        $information = Information::firstOrCreate([]);

        if ($information) {
            return redirect()->route('admin.information.edit', $information->id);
        }
        return view('admin.pages.information.create');
    }

    public function store(StoreInformationRequest $request){
        $information = Information::firstOrCreate([]);

        if ($information) {
            return redirect()->route('admin.information.edit', $information->id);
        }

        $validatedData = $request->validated();

        $information = Information::create($validatedData);

        $message = 'Thông tin đã được thêm thành công.';
        return redirect()->route('admin.information.edit', $information->id)
        ->with('message', $message);
        }

    public function edit($id){
        $information = Information::findOrFail($id);
        return view('admin.pages.information.edit', ['information' => $information]);
    }

    public function update(UpdateInformationRequest $request, $id){
    $validatedData = $request->validated();

    $information = Information::findOrFail($id);

    $information->fill($validatedData);

    if ($information->isDirty()) {
        $information->save();
        $message = 'Thông tin đã được cập nhật thành công.';
    } else {
        $message = 'Không có thông tin được cập nhật.';
    }

    return redirect()->route('admin.information.edit', $id)
        ->with('message', $message);
    }
}
