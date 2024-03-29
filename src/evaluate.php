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


function describe(string...$expressions): string
{
    return implode('', $expressions);
}

function matches(string $pattern, string $subject): bool
{
    return (bool) preg_match(
        '/' . $pattern . '/',
        $subject
    );
}