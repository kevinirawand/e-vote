<?php

namespace App\Models;

use App\Models\Choice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Polling extends Model
{
    use HasFactory;

    protected $table = "pollings";

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'created_by'
    ];

    public function choice(){
        return $this->hasMany(Choice::class, 'polling_id', 'id');
    }
}
