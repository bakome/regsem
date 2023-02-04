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
    return preg_quote($subject, '/');
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

function anyEnglishAlphabetLetter(): string
{
    return 'A-Za-z';
}

function anyLowerCaseEnglishAlphabetLetter(): string
{
    return 'a-z';
}

function hyphen(): string
{
    return literal('-');
}

function anyCharacterExceptNewLine(): string
{
    return '.';
}

function anyCharacterExceptLiteral($literal): string
{
    return '^' . $literal;
}

function alphabetic(): string
{
    return '[[:alpha:]]';
}

function digit(): string
{
    return '[[:digit:]]';
}

function alphanumeric(): string
{
    return '[[:alnum:]]';
}

function space(): string
{
    return '[[:space:]]';
}

function printable(): string
{
    return '[[:print:]]';
}

function nonPrintable(): string
{
    return '[[:cntrl:]]';
}

function lowercase(): string
{
    return '[[:lower:]]';
}

function uppercase(): string
{
    return '[[:upper:]]';
}

function nonDigit(): string
{
    return '\D';
}

function whitespace(): string
{
    return '\s';
}

function nonWhitespace(): string
{
    return '\S';
}

function word(): string
{
    return '\w';
}

function nonWord(): string
{
    return '\W';
}

function wordBoundary(): string
{
    return '\b';
}

function nonWordBoundary(): string
{
    return '\B';
}