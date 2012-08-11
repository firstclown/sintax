<?php

/**
 * Tests for the verb object of Sintax
 */

class Verb_Test extends Kohana_Unittest_TestCase {
	public function provider_verb() {
		return array(
			array( 'is', 'is' ),
			array( 'was walking', 'was walking' ),
		);
	}

	/**
	 * @dataProvider provider_verb
	 */
	public function test_verb( $word, $expected ) {
		$verb = new Verb( $word );
		$this->assertEquals( $expected, (string) $verb );
	}

	public function provider_verb_with_adverbs() {
		return array(
			array( 'is walking', array( 'effervesently' ), 'is walking effervesently' ),
			array( 'is walking', array( NULL, 'effervesently' ), 'is walking effervesently' ),
			array( 'is walking', array( 'effervesently', 'quickly' ), 'is walking effervesently and quickly' ),
			array( 'is walking', array( 'effervesently', 'quickly', 'efficiently' ), 'is walking effervesently, quickly and efficiently' ),
		);
	}

	/**
	 * @dataProvider provider_verb_with_adverbs
	 */
	public function test_verb_with_adverbs( $word, $adverb_list, $expected ) {
		$verb = new Verb( $word );
		foreach( $adverb_list as $adverb ) {
			$verb->adverb( $adverb );
		}
		$this->assertEquals( $expected, (string) $verb );
	}
}
