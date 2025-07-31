<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppInstance extends Model
{
    protected $fillable = ['user_id', 'instance_name', 'api_key'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
