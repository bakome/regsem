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
 * Regex to match email address.
 * @standard RFC 2822 standard email validation
 * @regex "
 *    [a-z0-9!#$%&'*+/=?^_`{|}~-]+
 *    (?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*
 *    @
 *    (?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+
 *    [a-z0-9]
 *    (?:[a-z0-9-]*[a-z0-9])?
 *  "
 */
function email(): string
{
    return describe(
        matchOneOrMoreClass(
            anyLowerCaseEnglishAlphabetLetter(),
            anyNumber(),
            literal('!#$%&\'*+=?^_`{|}~-/')
        ),
        matchZeroOrMoreOnlyGroup(
            literal('.'),
            matchOneOrMoreClass(
                anyLowerCaseEnglishAlphabetLetter(),
                anyNumber(),
                literal('!#$%&\'*+=?^_`{|}~-/')
            ),
        ),
        literal('@'),
        matchOneOrMoreOnlyGroup(
            cla2s(
                anyLowerCaseEnglishAlphabetLetter(),
                anyNumber(),
            ),
            matchZeroOrOneOnlyGroup(
                matchZeroOrMoreClass(
                    anyLowerCaseEnglishAlphabetLetter(),
                    anyNumber(),
                    hyphen()
                ),
                cla2s(
                    anyLowerCaseEnglishAlphabetLetter(),
                    anyNumber(),
                ),
            ),
            literal('.')
        ),
        cla2s(
            anyLowerCaseEnglishAlphabetLetter(),
            anyNumber(),
        ),
        matchZeroOrOneOnlyGroup(
            matchZeroOrMoreClass(
                anyLowerCaseEnglishAlphabetLetter(),
                anyNumber(),
                hyphen()
            ),
            cla2s(
                anyLowerCaseEnglishAlphabetLetter(),
                anyNumber(),
            ),
        ),
    );
}