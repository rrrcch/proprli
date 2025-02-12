<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'building_id',
        'created_by',
        'assigned_to',
        'status',
    ];

    /**
     * Get the building that owns the task.
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * Get the comments for the task.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the user that created the task.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user assigned to the task.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope for filtering by building
     */
    public function scopeForBuilding(Builder $query, string $buildingId): Builder
    {
        return $query->where('building_id', $buildingId);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if ($status) {
            $query->where('status', $status);
        }

        return $query;
    }

    /**
     * Scope for filtering by assigned user
     */
    public function scopeAssignedTo(Builder $query, ?int $assignedTo): Builder
    {
        if ($assignedTo) {
            $query->where('assigned_to', $assignedTo);
        }

        return $query;
    }

    /**
     * Scope for date range filtering
     */
    public function scopeCreatedBetween(
        Builder $query,
        ?string $startDate,
        ?string $endDate
    ): Builder {
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        return $query;
    }
}
