<?php

namespace App\Models;

use App\Models\Vote;
use App\Models\Polling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Choice extends Model
{
    use HasFactory;

    protected $table = "choices";

    protected $fillable = [
        'choice',
        'polling_id'
    ];

    public function vote(){
        return $this->hasMany(Vote::class, 'choice_id', 'id');
    }
}
