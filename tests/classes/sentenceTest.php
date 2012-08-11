<?php

/**
 * Tests for the sentence object of Sintax
 */

class Sentence_Test extends Kohana_Unittest_TestCase {
	public function test_quick_brown_fox() {
		$fox = new Noun( 'fox', 'the' );
		$fox->adjective( 'quick' );
		$fox->adjective( 'brown' );

		$jump = new Verb( 'jumped over' );

		$dog = new Noun( 'dog', 'the' );
		$dog->adjective( 'lazy' );

		$test_sentence = new Sentence();
		$test_sentence->add_part( $fox );
		$test_sentence->add_part( $jump );
		$test_sentence->add_part( $dog );

		$this->assertEquals('The quick, brown fox jumped over the lazy dog.', (string) $test_sentence );
	}

	public function test_building() {
		$building = new Noun( 'commercial building', 'a' );
		$building->adjective( 'two-story' );
		$building->adjective( 'five-bay' );

		$first_chimney = new Noun( 'chimney', 'one' );
		$first_chimney->adjective( 'front side' );
		$first_chimney->adjective( 'brick' );

		$second_chimney = new Noun( 'chimneys', 'two' );
		$second_chimney->adjective( 'back side' );
		$second_chimney->adjective( 'mortor' );

		$test_sentence = new Sentence( 'this', 'is' );
		$test_sentence->add_part( $building );
		$test_sentence->add_part( $first_chimney, 'with' );
		$test_sentence->add_part( $second_chimney, 'and' );

		$this->assertEquals('This is a two-story, five-bay commercial building with one front side, brick chimney and two back side, mortor chimneys.', (string) $test_sentence);
	}
		
}
