<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMoment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['messages'];

    public function messages(){
        return $this->belongsTo(UserMessage::class, 'user_massage_id');
    }
}
