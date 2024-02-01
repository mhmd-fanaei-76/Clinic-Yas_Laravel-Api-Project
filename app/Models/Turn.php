<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id','time_id','turns_date','confirmation'];

    public function times()
    {
        return $this->belongsTo(Time::class,'time_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'patient_id','id');
    }

}
