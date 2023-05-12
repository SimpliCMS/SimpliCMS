<?php

namespace Modules\Bookable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bookable\Contracts\BookableState as BookableStateContract;
use Konekt\Enum\Enum;

class BookableState extends Enum implements BookableStateContract {

    public const __DEFAULT = self::DRAFT;
    public const DRAFT = 'draft';
    public const INACTIVE = 'inactive';
    public const ACTIVE = 'active';
    public const UNAVAILABLE = 'unavailable';
    public const RETIRED = 'retired';

    protected static array $activeStates = [self::ACTIVE];

    public function isActive(): bool {
        return in_array($this->value, static::$activeStates);
    }

    public static function getActiveStates(): array {
        return static::$activeStates;
    }

}
