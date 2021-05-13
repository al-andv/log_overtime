<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $tablle = "Overtime";
    protected $fillable = ['date','date_type','user_id','time_start','time_end','work','over_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
