<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'order_position',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the list
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all tasks for this list
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id')->orderBy('order_position');
    }
}
