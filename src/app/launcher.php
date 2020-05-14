<?php
/**
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class launcher extends application {
	static function run( $dir = null) {
		new self( $dir ? $dir : dirname( __DIR__));

	}

}
