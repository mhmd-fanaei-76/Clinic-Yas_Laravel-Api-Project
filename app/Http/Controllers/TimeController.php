<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTimeRequest;
use App\Http\Resources\ShowTimeForAdmin;
use App\Http\Resources\ShowTimeResource;
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

    public function updateTime(Time $time,UpdateTimeRequest $request)
    {
        $time->update($request->validated());
        return response()->json([
            'message' => 'This Time Is Confirmed',
            'time' => $time
        ]);
    }

    public function deleteTime(Time $time)
    {
        $time->delete();
        return response()->json([
            'message' => 'Time Deleted'
        ]);
    }

    public function index(Request $request)
    {
        $day = $request->query('day');
        $doctor_id = $request->query('doctor_id');
        if ($day == null and $doctor_id == null ) {
            $time = Time::query()->where('confirmation',true)->with(["users", "sections"])->get();
            return ShowTimeResource::collection($time);
        }
        if($day != null && $doctor_id != null){
            $time = Time::query()->confirmed()->where('day', $day)
                ->where('doctor_id', $doctor_id)
                ->with(["users", "sections"])->get();
            return ShowTimeResource::collection($time);
        }
//        DB::enableQueryLog();
        $time = Time::query()->confirmed()->where('day', $day)
            ->orWhere('doctor_id', $doctor_id)
            ->with(["users", "sections"])->get();
//        dd(DB::getQueryLog());
        return ShowTimeResource::collection($time);
    }
}
