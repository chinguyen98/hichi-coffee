<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AdminRole extends Enum
{
    const SuperAdmin = 'SUPER_ADMIN';
    const NormalAdmin = 'NORMAL_ADMIN';
}
