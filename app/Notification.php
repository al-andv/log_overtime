<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $tablle = "Notification";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_from', 'id');
    }
}
