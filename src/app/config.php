<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

abstract class config extends dvc\config {
	const hello_db_version = 0.01;
	static protected $_HELLO_VERSION = 0;

	static function hello_checkdatabase() {
		if ( self::hello_version() < self::hello_db_version) {
			config::hello_version( self::hello_db_version);

			$dao = new dao\dbinfo;
			$dao->dump( $verbose = false);

		}

	}

	static function hello_config() {
		return implode([
			rtrim( self::dataPath(), '/ '),
			DIRECTORY_SEPARATOR,
			'hello.json',

		]);

	}

	static function hello_init() {
		if ( file_exists( $config = self::hello_config())) {
			$j = json_decode( file_get_contents( $config));

			if ( isset( $j->hello_version)) {
				self::$_HELLO_VERSION = (float)$j->hello_version;

			};

		}

	}

	static protected function hello_version( $set = null) {
		$ret = self::$_HELLO_VERSION;

		if ( (float)$set) {
			$config = self::hello_config();

			$j = file_exists( $config) ?
				json_decode( file_get_contents( $config)):
				(object)[];

			self::$_HELLO_VERSION = $j->hello_version = $set;

			file_put_contents( $config, json_encode( $j, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

		}

		return $ret;

	}

}

config::hello_init();
