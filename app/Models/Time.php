<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id','section_id','day','start_hours','end_hours','confirmation'];
    public function scopeConfirmed($query)
    {
        return $query->where('confirmation',true);
    }

    public function users()
    {
        return $this->belongsTo(User::class,'doctor_id','id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }

    public function turns()
    {
        return $this->hasMany(Turn::class,'time_id','id');
    }
}
