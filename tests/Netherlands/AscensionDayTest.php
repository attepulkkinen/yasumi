<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Carbon\Carbon;
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class for testing Ascension Day.
 *
 * Ascension Day commemorates the bodily Ascension of Jesus into heaven. It is one of the ecumenical feasts of Christian
 * churches. Ascension Day is traditionally celebrated on a Thursday, the fortieth day of Easter although some Catholic
 * provinces have moved the observance to the following Sunday.
 */
class AscensionDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Ascension Day.
     */
    public function testAscensionDay()
    {
        $year = 1754;
        $this->assertHoliday(self::COUNTRY, 'ascensionDay', $year, Carbon::createFromDate($year, 5, 23));
    }
}