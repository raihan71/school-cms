<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    public static function create($var = null)
    {
        $user = auth()->user();
        $activity = new Activity();
        $activity->person = $user->name;
        $activity->desc = $var;
        $activity->save();
    }
}
