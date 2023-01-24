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

/**
 * Match tells the engine to attempt to match the preceding token zero times or once, in effect making it optional.
 * @return string
 */
function matchZeroOrOnce(string $token): string
{
    return "[$token]?";
}
