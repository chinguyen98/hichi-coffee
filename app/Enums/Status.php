<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Status extends Enum
{
    const OrderChecking = 1;
    const OrderReceived = 2;
    const OrderShip = 3;
    const OrderFinish = 4;
}
