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

function matchZeroOrOneClass(string...$expressions): string
{
    return '[' . describe(...$expressions) . ']' . zeroOrOneLiteral();
}

function matchOneOrMoreClass(string...$expressions): string
{
    return '[' . describe(...$expressions) . ']' . oneOrMoreLiteral();
}

function matchZeroOrMoreClass(string...$expressions): string
{
    return '[' . describe(...$expressions) . ']' . zeroOrMoreLiteral();
}

function matchZeroOrMoreGroup(string...$expressions): string
{
    return '(' . describe(...$expressions) . ')' . zeroOrMoreLiteral();
}

function matchZeroOrOneGroup(string...$expressions): string
{
    return '(' . describe(...$expressions) . ')' . zeroOrOneLiteral();
}

function matchOneOrMoreGroup(string...$expressions): string
{
    return '(' . describe(...$expressions) . ')' . oneOrMoreLiteral();
}

function matchZeroOrMoreOnlyGroup(string...$expressions): string
{
    return describe(
        onlyGroup(...$expressions)
    )
        . zeroOrMoreLiteral();
}

function matchZeroOrOneOnlyGroup(string...$expressions): string
{
    return describe(
        onlyGroup(...$expressions)
    )
        . zeroOrOneLiteral();
}

function matchOneOrMoreOnlyGroup(string...$expressions): string
{
    return describe(
        onlyGroup(...$expressions)
    )
        . oneOrMoreLiteral();
}

function zeroOrMoreLiteral(): string
{
    return '*';
}

function oneOrMoreLiteral(): string
{
    return '+';
}

function zeroOrOneLiteral(): string
{
    return '?';
}