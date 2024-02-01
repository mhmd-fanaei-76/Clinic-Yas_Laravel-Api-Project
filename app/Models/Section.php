<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['section_name'];

    public function times()
    {
        return $this->hasMany(Time::class, 'section_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'section_id', 'id');
    }
}
