<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['nameQuestion', 'polls_id'];

    public function polls()
    {
        return $this->hasMany('App\Polls');
    }

    public function answers()
    {
        return $this->belongsToMany('App\Answers');
    }
}
