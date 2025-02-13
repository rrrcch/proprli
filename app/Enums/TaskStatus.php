<?php

namespace App\Enums;

enum TaskStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in-progress';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';

    /**
     * Get the label for a status.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::REJECTED => 'Rejected',
        };
    }
}
