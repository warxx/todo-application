<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = array(
        'name',
        'description',
        'user_id'
    );

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
