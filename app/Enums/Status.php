<?php

namespace App\Enums;

enum Status:string
{
    case PENDING = 'Pendente';
    case COMPLETED = 'Concluída';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
