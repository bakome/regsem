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
use function Bakome\RegSem\{
    regex,
    beginsWith,
    ceaseWith,
    bell,
    carriageReturn,
    escapeCharacter,
    formFeed,
    lineBreak,
    lineFeed,
    literal,
    matchZeroOrOnce,
    tab,
    verticalTab
};

final class RegexTest extends TestCase
{
    /** @test */
    public function create_regex()
    {
        $regex = regex();

        $this->assertInstanceOf(\Closure::class, $regex);
    }

    /** @test */
    public function regex_with_start_expression()
    {
        $regex = regex(
            beginsWith('Beginning test subject')
        );

        $this->assertFalse($regex('This is false test subject'));
        $this->assertTrue($regex('Beginning test subject as positive'));
    }

    /** @test */
    public function regex_with_end_expression()
    {
        $regex = regex(
            ceaseWith('Test subject with end expression')
        );

        $this->assertFalse($regex('This is false test subject'));
        $this->assertTrue($regex('A positive example of Test subject with end expression'));
    }

    /** @test */
    public function regex_with_begin_and_end()
    {
        $regex = regex(
            beginsWith('Beginning test subject'),
            ceaseWith(' with end expression')
        );        

        $this->assertTrue($regex('Beginning test subject with end expression'));
        $this->assertFalse($regex('False test subject'));
    }

    /** @test */
    public function regex_contains_literal()
    {
        $regex = regex(
            literal('bird')
        );        

        $this->assertTrue($regex('He turns into a bird in his hands and flies away.'));
        $this->assertFalse($regex('He turns into a frog in his hands and run away.'));
    }

    /** @test */
    public function regex_match_tab()
    {
        $regex = regex(
            tab()
        );   

        $this->assertTrue($regex("He turns into a bird in\this hands and flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_carriage_return()
    {
        $regex = regex(
            carriageReturn()
        );   

        $this->assertTrue($regex("He turns into a bird.\r He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_line_feed()
    {
        $regex = regex(
            lineFeed()
        );   

        $this->assertTrue($regex("He turns into a bird.\n He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_line_termination()
    {
        $regex = regex(
            lineBreak()
        );   

        $this->assertTrue($regex("He turns into a bird.\n He flies away."));
        $this->assertTrue($regex("He turns into a bird.\r\n He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_bell_character()
    {
        $regex = regex(
            bell()
        );   

        $this->assertTrue(
            $regex(
                "He turns into a bird.\07 He flies away."
            )
        ); // \07 Is a bell character \a in hex representation.
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_escape_character()
    {
        $regex = regex(
            escapeCharacter()
        );   

        $this->assertTrue($regex("He turns into a bird.\e He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_form_feed_character()
    {
        $regex = regex(
            formFeed()
        );   

        $this->assertTrue($regex("He turns into a bird.\f He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_with_ends_and_contains_special_characters()
    {
        $regex = regex(
            beginsWith('He turns into a bird.'),
            tab()
        );   
    
        $this->assertTrue($regex("He turns into a bird.\t He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));

        $regex = regex(
            beginsWith('He turns into a bird.'),
            tab(),
            ceaseWith(' He flies away.')
        );           

        $this->assertTrue($regex("He turns into a bird.\t He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_vertical_character()
    {
        $regex = regex(
            verticalTab()
        );                   

        $this->assertTrue($regex("He turns into a bird.\v He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_token_zero_or_once_making_optional_match()
    {
        $regex = regex(
            matchZeroOrOnce('bird')
        );                           

        $this->assertTrue($regex("He turns into a bird. He flies away."));
        $this->assertTrue($regex('He turns into in his hands and flies away.'));

        $regex = regex(
            literal('bir'),
            matchZeroOrOnce('d'),
            literal('.')
        );                           

        $this->assertTrue($regex("He turns into a bird. He flies away."));
        $this->assertTrue($regex("He turns into a bir. He flies away."));
        $this->assertFalse($regex("He turns into a bird He flies away."));
        $this->assertFalse($regex("He turns into a bir He flies away."));
    }
}
