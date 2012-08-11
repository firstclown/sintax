<?php

class Sentence {
	protected $parts;

	public function __toString() {
		if( ! empty( $this->parts ) ) {
			$sentence = (string) $this->parts[0];
			foreach( array_slice( $this->parts, 1 ) as $part ) {
				if( is_array($part) ) {
					$sentence .= (preg_match( '/^[\.:,;]$/', $part[1] )) ? '' : ' ' . $part[1] . ' ' . (string) $part[0];
				} else {
					$sentence .= ' ' . (string) $part;
				}
			}
		}

		return ucfirst($sentence) . '.';
	}

	public function __construct( $first_noun = NULL , $first_verb = NULL ) {
		if( ! empty( $first_noun ) ) {
			$this->parts[] = new Noun( $first_noun );
		}

		if( ! empty( $first_verb ) ) {
			$this->parts[] = new Verb( $first_verb );
		}
	}

	public function add_part( $section, $connector = NULL ) {
		if( ! empty( $section ) ) {
			if( ! empty( $connector ) ) {
				$this->parts[] = array( $section, $connector );
			} else {
				$this->parts[] = $section;
			}
		}
		
		// Allow chaining of this method
		return $this;
	}
}


