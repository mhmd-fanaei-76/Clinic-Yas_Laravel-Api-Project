<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowTurnsResource;
use App\Models\Time;
use App\Models\Turn;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    public function indexTurn(Request $request)
    {
        $confirmation = $request->query('confirmation');
        if($confirmation == null){
            $doctor_id = auth()->user()->id;
            $times = Time::query()->where('doctor_id', $doctor_id)->get()->pluck('id');
            $turn = Turn::query()->whereIn('time_id', $times)->get();
            return ShowTurnsResource::collection($turn);
        }
        $doctor_id = auth()->user()->id;
        $times = Time::query()->where('doctor_id', $doctor_id)->get()->pluck('id');
        $turn = Turn::query()->whereIn('time_id', $times)->where('confirmation',$confirmation)->get();
        return ShowTurnsResource::collection($turn);
    }
}
