<?php

namespace App\Models;

use App\Models\User;
use App\Models\Choice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $table = "votes";

    protected $fillable = [
        'choice_id',
        'polling_id',
        'user_id'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function polling(){
        return $this->hasOne(Polling::class, 'id', 'polling_id');
    }

    public function choice(){
        return $this->hasOne(Choice::class, 'id', 'choice_id');
    }
}
