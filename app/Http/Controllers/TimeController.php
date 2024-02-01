<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowTimeForAdmin;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function indexTime(Request $request)
    {
        $doctor_id = $request->query('doctor_id');
        $confirmation = $request->query('confirmation');
        if ($doctor_id == null  and $confirmation == null) {
            $time = Time::query()->with(["users", "sections"])->get();
            return ShowTimeForAdmin::collection($time);
        }
        if($doctor_id != null and $confirmation != null){
            $time = Time::query()->where('doctor_id', $doctor_id)
                ->where('confirmation',$confirmation)->get();
            return ShowTimeForAdmin::collection($time);
        }
        $time = Time::query()->where('doctor_id', $doctor_id)
            ->orWhere('confirmation',$confirmation)->get();
        return ShowTimeForAdmin::collection($time);
    }
}
