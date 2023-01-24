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
 * Regex begins with.
 * @param string $expression
 * @return string
 */
function beginsWith(string $expression): string
{
    return '^' . \preg_quote($expression);
}

/**
 * Regex begins with.
 * @param string $expression
 * @return string
 */
function ceaseWith(string $expression): string
{
    return \preg_quote($expression) . '$';
}
