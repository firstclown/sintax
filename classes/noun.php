<?php

class Noun {
	protected $word;
	protected $article;
	protected $adjectives;

	public function __toString() {
		$adjective_string = NULL;
		if( ! empty($this->adjectives) ) {
			$adjective_string = implode( ', ', $this->adjectives );
		}

		if( $this->article == 'a' ) {
			$comparer = empty( $adjective_string ) ? $this->word : $adjective_string;
			if(
				strncasecmp( 'a', $comparer, 1 ) === 0 ||
				strncasecmp( 'e', $comparer, 1 ) === 0 ||
				strncasecmp( 'i', $comparer, 1 ) === 0 ||
				( strncasecmp( 'o', $comparer, 1 ) === 0 && strncasecmp( 'on', $comparer, 2 ) !== 0 ) ||
				strncasecmp( 'ho', $comparer, 2 ) === 0 ||
				strncasecmp( 'un', $comparer, 2 ) === 0
			) {
				$this->article = 'an';
			}
		}
		$word_list = array_filter( array( $this->article, $adjective_string, $this->word ) );

		return implode( ' ', $word_list );
	}

	public function __construct( $word, $article = NULL ) {
		$this->word = trim( $word );
		$this->article = trim( $article );
	}

	public function adjective( $word = NULL ) {
		if( ! empty( $word ) ) {
			$this->adjectives[] = trim( $word );
		}
	}

	public function has_adjectives() {
		return ! empty( $this->adjectives );
	}
}
