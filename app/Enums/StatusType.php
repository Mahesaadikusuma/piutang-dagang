<?php

namespace App\Enums;

enum StatusType: string
{
      case PENDING = 'pending';
      case SUCCESS = 'success';
      case FAILED = 'failed';

      public function color(): string
      {
            return match ($this) {
                  self::PENDING => 'text-yellow-500',
                  self::SUCCESS => 'text-green-500',
                  self::FAILED => 'text-red-500',
            };
      }
}
