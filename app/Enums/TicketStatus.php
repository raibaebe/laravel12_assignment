<?php

namespace App\Enums;

enum TicketStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::IN_PROGRESS => 'In Progress',
            self::DONE => 'Done',
            self::REJECTED => 'Rejected',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NEW => 'blue',
            self::IN_PROGRESS => 'yellow',
            self::DONE => 'green',
            self::REJECTED => 'red',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
