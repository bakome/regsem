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

final class RegexTest extends TestCase
{
    /** @test */
    public function create_regex()
    {
        $regex = regsem\regex();

        $this->assertInstanceOf(\Closure::class, $regex);
    }

    /** @test */
    public function regex_with_start_expression()
    {
        $regex = regsem\regex(
            regsem\beginsWith('Beginning test subject')
        );

        $this->assertFalse($regex('This is false test subject'));
        $this->assertTrue($regex('Beginning test subject as positive'));
    }

    /** @test */
    public function regex_with_end_expression()
    {
        $regex = regsem\regex(
            regsem\ceaseWith('Test subject with end expression')
        );

        $this->assertFalse($regex('This is false test subject'));
        $this->assertTrue($regex('A positive example of Test subject with end expression'));
    }

    /** @test */
    public function regex_with_begin_and_end()
    {
        $regex = regsem\regex(
            regsem\beginsWith('Beginning test subject'),
            regsem\ceaseWith(' with end expression')
        );

        $this->assertTrue($regex('Beginning test subject with end expression'));
        $this->assertFalse($regex('False test subject'));
    }

    /** @test */
    public function regex_contains_literal()
    {
        $regex = regsem\regex(
            regsem\literal('bird')
        );

        $this->assertTrue($regex('He turns into a bird in his hands and flies away.'));
        $this->assertFalse($regex('He turns into a frog in his hands and run away.'));
    }

    /** @test */
    public function regex_match_tab()
    {
        $regex = regsem\regex(
            regsem\tab()
        );

        $this->assertTrue($regex("He turns into a bird in\this hands and flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_carriage_return()
    {
        $regex = regsem\regex(
            regsem\carriageReturn()
        );

        $this->assertTrue($regex("He turns into a bird.\r He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_line_feed()
    {
        $regex = regsem\regex(
            regsem\lineFeed()
        );

        $this->assertTrue($regex("He turns into a bird.\n He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_line_termination()
    {
        $regex = regsem\regex(
            regsem\lineBreak()
        );

        $this->assertTrue($regex("He turns into a bird.\n He flies away."));
        $this->assertTrue($regex("He turns into a bird.\r\n He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_bell_character()
    {
        $regex = regsem\regex(
            regsem\bell()
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
        $regex = regsem\regex(
            regsem\escapeCharacter()
        );

        $this->assertTrue($regex("He turns into a bird.\e He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_form_feed_character()
    {
        $regex = regsem\regex(
            regsem\formFeed()
        );

        $this->assertTrue($regex("He turns into a bird.\f He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_with_ends_and_contains_special_characters()
    {
        $regex = regsem\regex(
            regsem\beginsWith('He turns into a bird.'),
            regsem\tab()
        );

        $this->assertTrue($regex("He turns into a bird.\t He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));

        $regex = regsem\regex(
            regsem\beginsWith('He turns into a bird.'),
            regsem\tab(),
            regsem\ceaseWith(' He flies away.')
        );

        $this->assertTrue($regex("He turns into a bird.\t He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_vertical_character()
    {
        $regex = regsem\regex(
            regsem\verticalTab()
        );

        $this->assertTrue($regex("He turns into a bird.\v He flies away."));
        $this->assertFalse($regex('He turns into a bird in his hands and flies away.'));
    }

    /** @test */
    public function regex_match_token_zero_or_once()
    {
        $regexes = [
            regsem\regex(
                regsem\matchZeroOrOneClass('bird')
            ),
            regsem\regex(
                regsem\matchZeroOrOneGroup('bird')
            ),
            regsem\regex(
                regsem\matchZeroOrOneOnlyGroup('b')
            )
        ];

        foreach ($regexes as $regex) {
            $this->assertTrue($regex("He turns into a bird. He flies away."));
            $this->assertTrue($regex('He turns into in his hands and flies away.'));
        }

        $regexes = [
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchZeroOrOneClass('d'),
                regsem\literal('.')
            ),
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchZeroOrOneGroup('d'),
                regsem\literal('.')
            ),
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchZeroOrOneOnlyGroup('d'),
                regsem\literal('.')
            )
        ];

        foreach ($regexes as $regex) {
            $this->assertTrue($regex("He turns into a bird. He flies away."));
            $this->assertTrue($regex("He turns into a bir. He flies away."));
            $this->assertFalse($regex("He turns into a bird He flies away."));
            $this->assertFalse($regex("He turns into a bir He flies away."));
        }
    }

    /** @test */
    public function regex_match_token_one_or_more()
    {
        $regexes = [
            regsem\regex(
                regsem\matchOneOrMoreClass('b')
            ),
            regsem\regex(
                regsem\matchOneOrMoreGroup('b')
            ),
            regsem\regex(
                regsem\matchOneOrMoreOnlyGroup('b')
            )
        ];

        foreach ($regexes as $regex) {
            $this->assertTrue($regex("He turns into a bird. He flies away."));
            $this->assertFalse($regex('He turns into in his hands and flies away.'));
        }

        $regexes = [
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchOneOrMoreClass('d'),
                regsem\literal('.')
            ),
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchOneOrMoreGroup('d'),
                regsem\literal('.')
            ),
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchOneOrMoreOnlyGroup('d'),
                regsem\literal('.')
            )
        ];

        foreach ($regexes as $regex) {
            $this->assertTrue($regex("He turns into a bird. He flies away."));
            $this->assertFalse($regex("He turns into a bir. He flies away."));
            $this->assertTrue($regex("He turns into a birddd. He flies away."));
            $this->assertFalse($regex("He turns into a bir He flies away."));
        }
    }

    /** @test */
    public function regex_match_token_zero_or_more()
    {
        $regexes = [
            regsem\regex(
                regsem\matchZeroOrMoreClass('b')
            ),
            regsem\regex(
                regsem\matchZeroOrMoreGroup('b')
            ),
            regsem\regex(
                regsem\matchZeroOrMoreOnlyGroup('b')
            )
        ];

        foreach ($regexes as $regex) {
            $this->assertTrue($regex("He turns into a bird. He flies away."));
            $this->assertTrue($regex('He turns into in his hands and flies away.'));
            $this->assertTrue($regex('He turns into in his bb hands and flies away.'));
        }

        $regexes = [
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchZeroOrMoreClass('d'),
                regsem\literal('.')
            ),
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchZeroOrMoreGroup('d'),
                regsem\literal('.')
            ),
            regsem\regex(
                regsem\literal('bir'),
                regsem\matchZeroOrMoreOnlyGroup('d'),
                regsem\literal('.')
            )
        ];

        foreach ($regexes as $regex) {
            $this->assertTrue($regex("He turns into a bird. He flies away."));
            $this->assertTrue($regex("He turns into a bir. He flies away."));
            $this->assertTrue($regex("He turns into a birddd. He flies away."));
            $this->assertFalse($regex("He turns into a bir He flies away."));
        }
    }

    /** @test */
    public function regex_match_character_classes()
    {
        $regex = regsem\regex(
            regsem\alphabetic()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("123"));

        $regex = regsem\regex(
            regsem\digit()
        );

        $this->assertFalse($regex("He turns into a bird"));
        $this->assertTrue($regex("123"));

        $regex = regsem\regex(
            regsem\alphanumeric()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertTrue($regex("123"));
        $this->assertFalse($regex("#$%"));

        $regex = regsem\regex(
            regsem\space()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("123"));

        $regex = regsem\regex(
            regsem\printable()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("\t"));

        $regex = regsem\regex(
            regsem\nonPrintable()
        );

        $this->assertFalse($regex("He turns into a bird"));
        $this->assertTrue($regex("\t"));

        $regex = regsem\regex(
            regsem\uppercase()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("he turns into a bird"));

        $regex = regsem\regex(
            regsem\lowercase()
        );

        $this->assertFalse($regex("HE TURNS INTO A BIRD"));
        $this->assertTrue($regex("he turns into a bird"));
    }

    /** @test */
    public function regex_match_various_character()
    {
        $regex = regsem\regex(
            regsem\nonDigit()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("123"));

        $regex = regsem\regex(
            regsem\whitespace()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("123"));

        $regex = regsem\regex(
            regsem\nonWhitespace()
        );

        $this->assertFalse($regex(" "));
        $this->assertTrue($regex("123"));

        $regex = regsem\regex(
            regsem\word()
        );

        $this->assertTrue($regex("He turns into a bird"));
        $this->assertFalse($regex("$$%"));

        $regex = regsem\regex(
            regsem\nonWord()
        );

        $this->assertFalse($regex("He"));
        $this->assertTrue($regex("$$%"));

        $regex = regsem\regex(
            regsem\wordBoundary(),
            regsem\literal('cat') 
        );

        $this->assertTrue($regex("yellow cat"));
        $this->assertFalse($regex("certificate"));

        $regex = regsem\regex(
            regsem\nonWordBoundary(),
            regsem\literal('cat') 
        );

        $this->assertFalse($regex("yellow cat"));
        $this->assertTrue($regex("certificate"));
    }    
}