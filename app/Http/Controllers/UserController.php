<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(CreateUserRequest $request)
    {
        $data = $request->validated();
        $section_id = $data['section_id'];
        if($section_id != null){
            $doctor = User::query()->create($data);
            $doctor->assignRole('doctor');
            return response()->json([
                'message' => 'Doctor Created',
                'User' => $doctor,
            ]);
        }else {
            $admin = User::query()->create($data);
            $admin->assignRole('admin');
            return response()->json([
                'message' => 'Admin Created',
                'User' => $admin,
            ]);
        }
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User Deleted'
        ]);
    }

    public function updateUser(User $user,UpdateUserRequest $request)
    {
        $data = $request->validated();
        $user->update($data);
        return response()->json([
            'message' => 'User Updated',
            'User' => $user
        ]);
    }

    public function indexAdmin()
    {
        $admin = User::role('admin')->get();
        return response()->json([
            'User' => $admin
        ]);
    }

    public function indexDoctor()
    {
        $doctor = User::role('doctor')->get();
        return response()->json([
            'User' => $doctor
        ]);
    }
}
