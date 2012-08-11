<?php

/**
 * Tests for the noun object of Sintax
 */

class Noun_Test extends Kohana_Unittest_TestCase {
	public function provider_noun() {
		return array(
			array( 'chimney', 'one', 'one chimney'),
			array( 'chimney', NULL, 'chimney'),
			array( 'chimney', 'a', 'a chimney' ),
			array( 'owl', 'a', 'an owl' ),
		);
	}

	/**
	 * @dataProvider provider_noun
	 */
	public function test_noun( $noun_word, $article, $expected ) {
		$noun = new Noun($noun_word, $article);
		$this->assertEquals( $expected, (string) $noun );
	}

	public function provider_noun_with_adjectives() {
		return array(
			array( 'chimney', 'one', array( 'front-side', 'brick' ), 'one front-side, brick chimney', TRUE ),
			array( 'chimney', 'one', array( 'front-side' ), 'one front-side chimney', TRUE ),
			array( 'chimney', 'one', array( 'front-side', NULL ), 'one front-side chimney', TRUE ),
			array( 'chimney', 'one', array( NULL, NULL ), 'one chimney', FALSE),
			array( 'chimney', 'one', array(), 'one chimney', FALSE),
		);
	}

	/**
	 * @dataProvider provider_noun_with_adjectives
	 */
	public function test_noun_with_adjectives( $noun_word, $article, $adjective_array, $expected, $expected_has ) {
		$noun = new Noun($noun_word, $article);
		foreach( $adjective_array as $adjective ){
			$noun->adjective( $adjective );
		}
		$this->assertEquals( $expected, (string) $noun );
		$this->assertEquals( $expected_has, $noun->has_adjectives() );
	}
}
