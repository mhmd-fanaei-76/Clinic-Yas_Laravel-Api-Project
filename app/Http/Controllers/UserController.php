<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
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
                'Doctor' => $doctor,
            ]);
        }else {
            $admin = User::query()->create($data);
            $admin->assignRole('admin');
            return response()->json([
                'message' => 'Admin Created',
                'Admin' => $admin,
            ]);
        }
    }
}
