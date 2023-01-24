<?php declare(strict_types=1);
/**
 * This file is part of the RegSem library.
 *
 * Copyright (c) 2020 Aleksandar Bako Markovski <aleksandar.markovski_bako@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Bakome\RegSem;

use PHPUnit\Framework\TestCase;
use function Bakome\RegSem\{
    regex,
    email
};

final class PopularRegexTest extends TestCase
{
    /** @test */
    public function email_regex()
    {
        $regex = regex(
            email()
        );

        $this->assertTrue(
                $regex('test@email.com')
        );

        $this->assertFalse(
                $regex('testfail.com')
        );
    }
}