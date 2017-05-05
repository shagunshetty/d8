<?php

namespace Drupal\my_d8_demo;

use Drupal\Core\Database\Connection;

class DbWrapper {
	private $database;
	public function __construct(Connection $database) {
		$this->database = $database;
	}
	public function getData($fname, $lname) {
		$query = $this->database->select ( 'my_d8_demo_table', 'm' );
		$query->addField ( 'm', 'first_name' );
		$query->addField ( 'm', 'last_name' );
		$query->condition ( 'm.first_name', $fname );
		$query->condition ( 'm.last_name', $lname );
		$query->range ( 0, 1 );

		$result = $query->execute ()->fetchField ();
	}
	public function setData($fname, $lname) {
		$Data = db_insert ( 'my_d8_demo_table' )->fields ( array (
				'first_name' => $fname,
				'last_name' => $lname
		) )->execute ();
	}
}