<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class home extends Controller {
	protected function before() {
		config::hello_checkdatabase();
		parent::before();

	}

	protected function posthandler() {
		$action = $this->getPost('action');

		if ( 'todo-add-item' == $action) {
			$a = [
				'description' => (string)$this->getPost('description')

			];

			if ( $a['description']) {
				$dao = new dao\todo;
				$dao->Insert( $a);

				\Json::ack( $action);

			}
			else {
				\Json::nak( $action);

			}

		}
		elseif ( 'todo-delete-item' == $action) {
			if ( $id = (int)$this->getPost( 'id')) {
				$dao = new dao\todo;
				$dao->delete( $id);
				\Json::ack( $action);

			}
			else {
				\Json::nak( $action);

			}

		}
		elseif ( 'todo-get-items' == $action) {
			/*
			((_) =>
				_.post({
					url : _.url('<?= $this->route ?>'),
					data : { action : 'todo-get-items' },

				}).then( ( d) => {
					console.log( d.data);

				});

			)(_brayworth_);

			 */
			$dao = new dao\todo;
			if ( $res = $dao->getAll()) {
				\Json::ack( $action)
					->add( 'data', $res->dtoSet());

			}
			else {
				\Json::nak( $action);

			}

		} else { parent::postHandler(); }

	}

	protected function _index() {
		$this->render([
			'title' => 'Hello World',
			'primary' => 'Readme',
			'secondary' => [ 'index', 'todo']
		]);

	}

	function tictactoe() {
		$this->modal([
			'title' => 'tic tac toe',
			'load' => 'tictactoe',
		]);

	}

	function info() {
		/* default setting
		 * in case you forget to disable this on a production server
		 * - only running on localhost
		 */
		if ( $this->Request->ServerIsLocal()) {
			$this->render([
				'title' => 'hello world',
				'primary' => 'info',
				'secondary' =>'blank'
			]);

		}

	}

}
