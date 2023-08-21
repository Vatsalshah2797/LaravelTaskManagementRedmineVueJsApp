<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date', 'assignee_id', 'project_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    //One to many Relationship
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
