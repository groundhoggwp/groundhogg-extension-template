<?php

namespace GroundhoggExtension\Steps\Actions;

use Groundhogg\Step;
use Groundhogg\Steps\Actions\Action;

class Custom_Action extends Action{

	public function get_name() {
		return 'Custom Action';
	}

	public function get_type() {
		return 'custom_action';
	}

	public function get_description() {
		return 'A description of what your action does';
	}

	public function get_icon() {
		return 'https://via.placeholder.com/150';
	}

	/**
	 * Display any settings
	 *
	 * @param Step $step
	 */
	public function settings( $step ) {
		// TODO: Implement settings() method.
	}

	/**
	 * Save any settings
	 *
	 * @param Step $step
	 */
	public function save( $step ) {
		// TODO: Implement save() method.
	}

	/**
	 * What happens when the action is actually run for the first time.
	 *
	 * @param \Groundhogg\Contact $contact
	 * @param \Groundhogg\Event   $event
	 *
	 * @return bool|void
	 */
	public function run( $contact, $event ) {
		$contact->add_note( 'A a note to the contact.' );
	}
}
