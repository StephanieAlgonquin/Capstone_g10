<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'progress',
        'is_completed',
        'is_archived',
        'order_position',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'is_archived' => 'boolean',
        'due_date' => 'datetime',
        'progress' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the list that owns the task
     */
    public function list()
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }

    /**
     * Get all users assigned to this task
     */
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'task_assignments', 'task_id', 'user_id')
                    ->withTimestamps();
    }
}
