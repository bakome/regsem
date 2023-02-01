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
    matchZeroOrOneClass,
    matchZeroOrMoreClass,
    tab,
    group,
    onlyGroup,
    matchOneOrMoreClass,
    verticalTab,
    anyEnglishAlphabetLetter,
    anyLowerCaseEnglishAlphabetLetter,
    anyNumber,
    zeroOrMoreLiteral,
    cla2s,
    oneOrMoreLiteral,
    zeroOrOneLiteral,
    matchZeroOrMoreGroup,
    matchZeroOrOneGroup,
    matchOneOrMoreGroup,
    matchZeroOrMoreOnlyGroup,
    matchZeroOrOneOnlyGroup,
    matchOneOrMoreOnlyGroup
};

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
    public function expression_match_token_zero_or_once_optional_class()
    {
        $this->assertEquals('[aToken]?', matchZeroOrOneClass('aToken'));
    }

    /** @test */
    public function expression_match_token_zero_or_more_class()
    {
        $this->assertEquals('[aToken]*', matchZeroOrMoreClass('aToken'));
    }        

    /** @test */
    public function expression_match_token_zero_or_more_group()
    {
        $this->assertEquals('(aToken)*', matchZeroOrMoreGroup('aToken'));
    }            

    /** @test */
    public function expression_match_token_zero_or_once_group()
    {
        $this->assertEquals('(aToken)?', matchZeroOrOneGroup('aToken'));
    }            

    /** @test */
    public function expression_match_token_one_or_more_group()
    {
        $this->assertEquals('(aToken)+', matchOneOrMoreGroup('aToken'));
    }            

    /** @test */
    public function expression_match_only_group_zero_or_more()
    {
        $this->assertEquals('(?:aToken)*', matchZeroOrMoreOnlyGroup('aToken'));
    }            

    /** @test */
    public function expression_match_only_group_zero_or_one()
    {
        $this->assertEquals('(?:aToken)?', matchZeroOrOneOnlyGroup('aToken'));
    }                

    /** @test */
    public function expression_match_only_group_one_or_more()
    {
        $this->assertEquals('(?:aToken)+', matchOneOrMoreOnlyGroup('aToken'));
    }                

    /** @test */
    public function create_expressions_groups()
    {
        $this->assertEquals('(aGroupExample)', group(
            literal('aGroupExample')
        ));
    }    

    /** @test */
    public function create_expressions_only_groups_with_non_capture_subpatterns()
    {
        $this->assertEquals('(?:aOnlyGroupExample)', onlyGroup(
            literal('aOnlyGroupExample')
        ));
    }    

    /** @test */
    public function create_expressions_with_class()
    {
        $this->assertEquals('[aClassExample]', cla2s(
            literal('aClassExample')
        ));
    }            
    
    /** @test */
    public function expression_match_one_or_more()
    {
        $this->assertEquals('[aToken]+', matchOneOrMoreClass('aToken'));
    }   
    
    /** @test */
    public function expression_contains_any_english_letter_alphabet_charachter()
    {
        $this->assertEquals('A-Za-z', anyEnglishAlphabetLetter());
    }    

    /** @test */
    public function expression_contains_any_lowercase_english_letter_alphabet_charachter()
    {
        $this->assertEquals('a-z', anyLowerCaseEnglishAlphabetLetter());
    }   
    
    /** @test */
    public function expression_contains_any_number()
    {
        $this->assertEquals('0-9', anyNumber());
    }   

    /** @test */
    public function expression_contains_zero_or_more_literal()
    {
        $this->assertEquals('*', zeroOrMoreLiteral());
    }       

    /** @test */
    public function expression_contains_one_or_more_literal()
    {
        $this->assertEquals('+', oneOrMoreLiteral());
    }           


    /** @test */
    public function expression_contains_zero_or_one_literal()
    {
        $this->assertEquals('?', zeroOrOneLiteral());
    }           
}
