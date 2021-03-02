<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'startDate',
        'duration'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
