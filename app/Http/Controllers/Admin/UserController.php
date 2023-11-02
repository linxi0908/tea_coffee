<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id',2)
        ->Orderby('created_at', 'desc')
        ->paginate(10);
        return view('admin.pages.user.list',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role_id = Role::get();
        return view('admin.pages.user.create', ['role_id' => $role_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request){
        $userData = $request->validated();
        $roleId = $request->input('role_id');


        $user = User::createUser($userData, $roleId);

        if (!$user) {
            return response()->json(['message' => 'Tạo người dùng không thành công.'], 400);
        }
        //session flash
        return redirect()->route('admin.user.index')->with('success', 'Tạo tài người dùng thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);

        $role_id = Role::get();

        return view('admin.pages.user.detail',['user' => $user,'role_id' => $role_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role_id === 1) {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validated();

        // Fill the user attributes
        $user->fill($validatedData);

        // Hash the password if provided
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }
        // Save the user
        $user->save();
        return redirect()->route('admin.user.index', $user->id)
        ->with('success', 'Cập nhật người dùng thành công.');
        }





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->delete();
        $message = $user ? 'Xóa người dùng thành công.' : 'Xóa người dùng thất bại.';
        return redirect()->route('admin.user.index')->with('message', $message);
    }
}
