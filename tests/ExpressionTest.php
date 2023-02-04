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
use Bakome\RegSem as regsem;

final class ExpressionTest extends TestCase
{
    /** @test */
    public function regex_begins_with()
    {
        $this->assertEquals('^aBeginning', regsem\beginsWith('aBeginning'));
        $this->assertEquals('^a\^Beginning', regsem\beginsWith('a^Beginning'));
    }

    /** @test */
    public function regex_cease_with()
    {
        $this->assertEquals('aEnd$', regsem\ceaseWith('aEnd'));
        $this->assertEquals('a\^End$', regsem\ceaseWith('a^End'));
    }

    /** @test */
    public function expression_literal()
    {
        $this->assertEquals('aLiteral', regsem\literal('aLiteral'));
        $this->assertEquals('a\^Literal', regsem\literal('a^Literal'));
    }

    /** @test */
    public function expression_contains_tab()
    {
        $this->assertEquals('\\t', regsem\tab());
    }

    /** @test */
    public function expression_contains_carriage_return()
    {
        $this->assertEquals('\\r', regsem\carriageReturn());
    }

    /** @test */
    public function expression_contains_line_feed()
    {
        $this->assertEquals('\\n', regsem\lineFeed());
    }

    /** @test */
    public function expression_contains_line_termination()
    {
        $this->assertEquals('\\r?\\n', regsem\lineBreak());
    }

    /** @test */
    public function expression_contains_bell_character()
    {
        $this->assertEquals('\\a', regsem\bell());
    }

    /** @test */
    public function expression_contains_escape_character()
    {
        $this->assertEquals('\\e', regsem\escapeCharacter());
    }

    /** @test */
    public function expression_contains_form_feed()
    {
        $this->assertEquals('\\f', regsem\formFeed());
    }

    /** @test */
    public function expression_contains_vertical_tab()
    {
        $this->assertEquals('\\v', regsem\verticalTab());
    }

    /** @test */
    public function expression_match_token_zero_or_once_optional_class()
    {
        $this->assertEquals('[aToken]?', regsem\matchZeroOrOneClass('aToken'));
    }

    /** @test */
    public function expression_match_token_zero_or_more_class()
    {
        $this->assertEquals('[aToken]*', regsem\matchZeroOrMoreClass('aToken'));
    }

    /** @test */
    public function expression_match_token_zero_or_more_group()
    {
        $this->assertEquals('(aToken)*', regsem\matchZeroOrMoreGroup('aToken'));
    }

    /** @test */
    public function expression_match_token_zero_or_once_group()
    {
        $this->assertEquals('(aToken)?', regsem\matchZeroOrOneGroup('aToken'));
    }

    /** @test */
    public function expression_match_token_one_or_more_group()
    {
        $this->assertEquals('(aToken)+', regsem\matchOneOrMoreGroup('aToken'));
    }

    /** @test */
    public function expression_match_only_group_zero_or_more()
    {
        $this->assertEquals('(?:aToken)*', regsem\matchZeroOrMoreOnlyGroup('aToken'));
    }

    /** @test */
    public function expression_match_only_group_zero_or_one()
    {
        $this->assertEquals('(?:aToken)?', regsem\matchZeroOrOneOnlyGroup('aToken'));
    }

    /** @test */
    public function expression_match_only_group_one_or_more()
    {
        $this->assertEquals('(?:aToken)+', regsem\matchOneOrMoreOnlyGroup('aToken'));
    }

    /** @test */
    public function create_expressions_groups()
    {
        $this->assertEquals(
            '(aGroupExample)',
            regsem\group(
                regsem\literal('aGroupExample')
            )
        );
    }

    /** @test */
    public function create_expressions_only_groups_with_non_capture_subpatterns()
    {
        $this->assertEquals(
            '(?:aOnlyGroupExample)',
            regsem\onlyGroup(
                regsem\literal('aOnlyGroupExample')
            )
        );
    }

    /** @test */
    public function create_expressions_with_class()
    {
        $this->assertEquals(
            '[aClassExample]',
            regsem\cla2s(
                regsem\literal('aClassExample')
            )
        );
    }

    /** @test */
    public function expression_match_one_or_more()
    {
        $this->assertEquals('[aToken]+', regsem\matchOneOrMoreClass('aToken'));
    }

    /** @test */
    public function expression_contains_any_english_letter_alphabet_charachter()
    {
        $this->assertEquals('A-Za-z', regsem\anyEnglishAlphabetLetter());
    }

    /** @test */
    public function expression_contains_any_lowercase_english_letter_alphabet_charachter()
    {
        $this->assertEquals('a-z', regsem\anyLowerCaseEnglishAlphabetLetter());
    }

    /** @test */
    public function expression_contains_any_number()
    {
        $this->assertEquals('0-9', regsem\anyNumber());
    }

    /** @test */
    public function expression_contains_zero_or_more_literal()
    {
        $this->assertEquals('*', regsem\zeroOrMoreLiteral());
    }

    /** @test */
    public function expression_contains_one_or_more_literal()
    {
        $this->assertEquals('+', regsem\oneOrMoreLiteral());
    }


    /** @test */
    public function expression_contains_zero_or_one_literal()
    {
        $this->assertEquals('?', regsem\zeroOrOneLiteral());
    }

    /** @test */
    public function expression_match_any_character_except_new_line()
    {
        $this->assertEquals('.', regsem\anyCharacterExceptNewLine());
    }

    /** @test */
    public function expression_match_any_character_except_literal()
    {
        $this->assertEquals('^x', regsem\anyCharacterExceptLiteral('x'));
    }

    /** @test */
    public function expression_match_repetition_exact_times()
    {
        $this->assertEquals('{10}', regsem\matchExactTimes(10));
    }

    /** @test */
    public function expression_match_repetition_at_least_times()
    {
        $this->assertEquals('{12,}', regsem\matchAtLeastTimes(12));
    }


    /** @test */
    public function expression_match_repetition_with_occurrences_range()
    {
        $this->assertEquals('{5,10}', regsem\matchOccurrencesRange(5, 10));
    }

    /** @test */
    public function expression_match_alphabetic_character()
    {
        $this->assertEquals('[[:alpha:]]', regsem\alphabetic());
    }

    /** @test */
    public function expression_match_digit()
    {
        $this->assertEquals('[[:digit:]]', regsem\digit());
    }

    /** @test */
    public function expression_match_alphanumeric()
    {
        $this->assertEquals('[[:alnum:]]', regsem\alphanumeric());
    }

    /** @test */
    public function expression_match_space()
    {
        $this->assertEquals('[[:space:]]', regsem\space());
    }

    /** @test */
    public function expression_match_printable_character()
    {
        $this->assertEquals('[[:print:]]', regsem\printable());
    }

    /** @test */
    public function expression_match_non_printable_character()
    {
        $this->assertEquals('[[:cntrl:]]', regsem\nonPrintable());
    }

    /** @test */
    public function expression_match_uppercase_character()
    {
        $this->assertEquals('[[:upper:]]', regsem\uppercase());
    }

    /** @test */
    public function expression_match_lowercase_character()
    {
        $this->assertEquals('[[:lower:]]', regsem\lowercase());
    }

    /** @test */
    public function expression_match_non_digit_character()
    {
        $this->assertEquals('\D', regsem\nonDigit());
    }

    /** @test */
    public function expression_match_whitespace_character()
    {
        $this->assertEquals('\s', regsem\whitespace());
    }

    /** @test */
    public function expression_match_non_whitespace_character()
    {
        $this->assertEquals('\S', regsem\nonWhitespace());
    }

    /** @test */
    public function expression_match_word_character()
    {
        $this->assertEquals('\w', regsem\word());
    }

    /** @test */
    public function expression_match_non_word_character()
    {
        $this->assertEquals('\W', regsem\nonWord());
    }

    /** @test */
    public function expression_match_word_boundary_character()
    {
        $this->assertEquals('\b', regsem\wordBoundary());
    }

    /** @test */
    public function expression_match_non_word_boundary_character()
    {
        $this->assertEquals('\B', regsem\nonWordBoundary());
    }
}