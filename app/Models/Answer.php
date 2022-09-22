<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['nameAnswer', 'questions_id'];

    public function questions()
    {
        return $this->hasMany('App\Questions');
    }
}
