<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['place','appointment','exit_time','arrive_time','roles','policyId'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopeExitTime($query){
            $query->orderBy('arrive_time','asc');
    }

    public function scopeDateTime($query){
        $query->orderBy('date','asc');
    }


}
