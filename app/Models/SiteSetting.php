<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
    public function user(){
        return $this->belongsTo(Service::class,'user_id');
    }
}
