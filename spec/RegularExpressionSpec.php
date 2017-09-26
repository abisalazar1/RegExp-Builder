<?php

namespace spec;

use RegularExpression;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegularExpressionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RegularExpression::class);
    }

    function it_has_a_generate_method_and_adds_the_delimiters () {
        $this->generate()
            ->shouldReturn('//');
    }

    function it_has_a_look_for_method_that_passes_the_desire_string_to_the_regular_expression () {

        $this->lookFor('youtube')
            ->generate()
            ->shouldReturn('/youtube/');

    }

    function it_has_a_look_for_group_method_that_passes_the_desire_string_and_group_them_to_the_regular_expression () {

        $this->lookForGroup('youtube')
            ->generate()
            ->shouldReturn('/(?:youtube)/');
    }

    function it_has_a_look_for_set_method_that_passes_the_desire_set_of_characters_to_the_regular_expression () {

        $this->lookForSet('youtube')
            ->generate()
            ->shouldReturn('/[youtube]/');
    }

    function it_has_a_limit_method_that_limits_the_amount_of_characters_of_the_regular_expression () {

        $this->lookForSet('youtube')
            ->limit(5, 10)
            ->generate()
            ->shouldReturn('/[youtube]{5,10}/');

    }

    function it_has_a_or_this_group_method_that_adds_the_conditional_to_the_regular_expression () {

        $this->lookForGroup('youtube')
            ->orThisGroup('chocolate')
            ->generate()
            ->shouldReturn('/(?:youtube)|(?:chocolate)/');

    }

    function it_has_a_or_this_set_method_that_adds_the_conditional_to_the_regular_expression () {

        $this->lookForSet('youtube')
            ->orThisSet('chocolate')
            ->generate()
            ->shouldReturn('/[youtube]|[chocolate]/');

    }

    function it_has_a_conditional_group_method_that_adds_the_conditional_to_the_regular_expression () {

        $this->conditionalGroup('youtube')
            ->generate()
            ->shouldReturn('/(?:youtube)?/');

    }

    function it_has_a_continue_method_that_will_allow_the_regular_expression_to_keep_selection () {

        $this->lookForGroup('youtube')
            ->regContinue()
            ->generate()
            ->shouldReturn('/(?:youtube).+/');

    }

    function it_has_a_negate_set_method_that_will_pass_a_set_of_characters_to_be_negated () {

        $this->lookForGroup('youtube')
            ->regContinue()
            ->negateSet(' &')
            ->generate()
            ->shouldReturn('/(?:youtube).+[^ &]/');

    }
    function it_has_a_negate_group_method_that_will_pass_a_group_of_characters_to_be_negated () {

        $this->lookForGroup('youtube')
            ->regContinue()
            ->negateGroup('lala')
            ->generate()
            ->shouldReturn('/(?:youtube).+(^lala)/');

    }

    function it_has_a_ignore_capitalization_method_that_will_set_the_regexp_to_not_be_case_sensitive () {

        $this->lookForGroup('youtube')
            ->regContinue()
            ->negateGroup('lala')
            ->ignoreCapitalization()
            ->generate()
            ->shouldReturn('/(?:youtube).+(^lala)/i');

    }

    function it_has_a_global_search_method_that_will_set_the_regexp_to_search_globally () {

        $this->lookForGroup('youtube')
            ->regContinue()
            ->negateGroup('lala')
            ->globalSearch()
            ->generate()
            ->shouldReturn('/(?:youtube).+(^lala)/g');

    }

}
