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
use function Bakome\RegSem\{beginsWith,
    bell,
    carriageReturn,
    ceaseWith,
    escapeCharacter,
    formFeed,
    lineBreak,
    lineFeed,
    literal,
    matchZeroOrOnce,
    tab,
    verticalTab};

final class ExpressionTest extends TestCase
{
    /** @test */
    public function regex_begins_with()
    {
        $this->assertEquals('^aBeginning', beginsWith('aBeginning'));
        $this->assertEquals('^a\^Beginning', beginsWith('a^Beginning'));
    }

    /** @test */
    public function regex_cease_with()
    {
        $this->assertEquals('aEnd$', ceaseWith('aEnd'));
        $this->assertEquals('a\^End$', ceaseWith('a^End'));
    }

    /** @test */
    public function expression_literal()
    {
        $this->assertEquals('aLiteral', literal('aLiteral'));
        $this->assertEquals('a\^Literal', literal('a^Literal'));
    }

    /** @test */
    public function expression_contains_tab()
    {
        $this->assertEquals('\\t', tab());
    }

    /** @test */
    public function expression_contains_carriage_return()
    {
        $this->assertEquals('\\r', carriageReturn());
    }

    /** @test */
    public function expression_contains_line_feed()
    {
        $this->assertEquals('\\n', lineFeed());
    }

    /** @test */
    public function expression_contains_line_termination()
    {
        $this->assertEquals('\\r?\\n', lineBreak());
    }

    /** @test */
    public function expression_contains_bell_character()
    {
        $this->assertEquals('\\a', bell());
    }

    /** @test */
    public function expression_contains_escape_character()
    {
        $this->assertEquals('\\e', escapeCharacter());
    }

    /** @test */
    public function expression_contains_form_feed()
    {
        $this->assertEquals('\\f', formFeed());
    }

    /** @test */
    public function expression_contains_vertical_tab()
    {
        $this->assertEquals('\\v', verticalTab());
    }

    /** @test */
    public function expression_match_token_zero_or_once_optional()
    {
        $this->assertEquals('[aToken]?', matchZeroOrOnce('aToken'));
    }
}
