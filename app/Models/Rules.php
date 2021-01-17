<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'alert_text',
        'user_id'
    ];

    public function triggers(){
        return $this->hasMany(Triggers::class,'rule_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
