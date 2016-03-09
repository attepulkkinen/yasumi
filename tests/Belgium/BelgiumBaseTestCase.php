<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\Belgium;

use PHPUnit_Framework_TestCase;
use Yasumi\Tests\YasumiBase;

/**
 * Class BelgiumBaseTestCase.
 */
abstract class BelgiumBaseTestCase extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Country (name) to be tested
     */
    const REGION = 'Belgium';

    /**
     * Timezone in which this provider has holidays defined
     */
    const TIMEZONE = 'Europe/Brussels';

    /**
     * List of holidays (shortnames) that are generally expected to be defined
     */
    public static $expectedHolidays = [
        'newYearsDay',
        'easter',
        'easterMonday',
        'internationalWorkersDay',
        'ascensionDay',
        'pentecost',
        'pentecostMonday',
        'assumptionOfMary',
        'nationalDay',
        'allSaintsDay',
        'armisticeDay',
        'christmasDay'
    ];
}