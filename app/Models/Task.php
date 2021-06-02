<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const todo = 'todo';
    const completed = 'completed';

    protected $fillable = array(
        'name',
        'description',
        'user_id',
        'status_id'
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

    public function project()
    {
        return $this->belongsTo(Project::class);
    }  
}
