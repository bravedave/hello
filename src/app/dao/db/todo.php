<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

namespace dao;
use config;

/* ========================================================================================= */
$dbc = 'sqlite' == config::$DB_TYPE ?
	new \dvc\sqlite\dbCheck( $this->db, 'todo' ) :
	new \dao\dbCheck( $this->db, 'todo' );

$dbc->defineField( 'description', 'varchar');
$dbc->check();

