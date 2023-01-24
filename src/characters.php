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


function literal(string $subject): string
{
    return preg_quote($subject);
}

function tab(): string
{
    return '\\t';
}

function carriageReturn(): string
{
    return '\\r';
}

function lineFeed(): string
{
    return '\\n';
}

function lineBreak(): string
{
    return '\\r?\\n';
}

function bell(): string
{
    return '\\a';
}

function escapeCharacter(): string
{
    return '\\e';
}

function formFeed(): string
{
    return '\\f';
}

function verticalTab(): string
{
    return '\\v';
}
