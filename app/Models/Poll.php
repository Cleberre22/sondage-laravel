<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = ['nameSondage'];

    public function questions()
    {
        return $this->belongsToMany('App\Questions');
    }
}
