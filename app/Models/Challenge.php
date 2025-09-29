<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'title', 'description', 'xp_reward'];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
