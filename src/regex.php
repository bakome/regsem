<?php declare(strict_types=1);
/**
 * This file is part of the RegSem library.
 *
 * Copyright (c) 2020 Aleksandar Bako Markovski <aleksandar.markovski_bako@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bakome\RegSem;

function regex(string...$expressions): \Closure
{
    $pattern = describe(...$expressions);

    return function (string $subject) use ($pattern) {
        return matches($pattern, $subject);
    };
}