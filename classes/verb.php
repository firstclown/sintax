<?php

class Verb {
	protected $word;
	protected $adverbs;

	public function __toString() {
		$adverb_string = NULL;
		if( ! empty($this->adverbs) ) {
			$adverbs_count = count( $this->adverbs );
			if( $adverbs_count > 1 ) {
				$adverb_string = implode( ', ', array_slice( $this->adverbs, 0, -1 ) );
				$adverb_string .= ' and ' . $this->adverbs[ $adverbs_count - 1 ];
			} else {
				$adverb_string = $this->adverbs[0];
			}
		}

		$word_list = array_filter( array( $this->word, $adverb_string ) );
		return implode( ' ', $word_list );
	}

	public function __construct( $word ) {
		$this->word = trim( $word );
	}

	public function adverb( $word ) {
		if( ! empty( $word ) ) {
			$this->adverbs[] = trim( $word );
		}
	}
}
