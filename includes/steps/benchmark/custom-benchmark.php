<?php

namespace GroundhoggExtension\Steps\Benchmarks;

use Groundhogg\Contact;
use Groundhogg\HTML;
use Groundhogg\Plugin;
use Groundhogg\Step;
use Groundhogg\Steps\Benchmarks\Benchmark;
use function Groundhogg\get_contactdata;
use function Groundhogg\html;

class Custom_Benchmark extends Benchmark{

	public function get_name() {
		return __( 'Custom Benchmark', 'groundhogg-extension' );
	}

	public function get_type() {
		return 'my_custom_extension';
	}

	public function get_description() {
		return __( 'Add a custom description here.' );
	}

	public function get_icon() {
		return 'https://via.placeholder.com/150';
	}

	/**
	 * output the settings
	 *
	 * @param Step $step
	 */
	public function settings( $step ) {

		html()->start_form_table();
		html()->start_row();

		html()->th( 'My custom setting' );
		html()->td( html()->dropdown( [
			'name'        => $this->setting_name_prefix( 'my_custom_setting' ),
			'id'          => $this->setting_id_prefix( 'my_custom_setting' ),
			'class'             => '',
			'options'           => [
				'a' => 'Option A',
				'b' => 'Option B'
			],
			'selected'          => $this->get_setting( 'my_custom_setting' ),
			'multiple'          => false,
			'option_none'       => 'Please select one',
			'option_none_value' => '',
		] ) );

		html()->end_row();
		html()->end_form_table();

	}

	/**
	 * Save the settings.
	 *
	 * @param Step $step
	 */
	public function save( $step ) {
		$this->save_setting( 'my_custom_setting', sanitize_text_field( $this->get_posted_data( 'my_custom_setting' ) ) );

	}

	/**
	 * @return int[]
	 */
	protected function get_complete_hooks() {
		return [
			// Action & number of args
			'did_something' => 2
		];
	}

	/**
	 * This is the callback for the actions registered in `get_complete_hooks()`
	 *
	 * @param mixed $arg1
	 * @param mixed $arg2
	 */
	public function setup( $arg1, $arg2 ){
		$this->add_data( 'arg1', $arg1 );
		$this->add_data( 'arg2', $arg2 );
	}

	/**
	 * IF this is a live action being done by a visitor you can reference the contact from the tracking cookie
	 * Otherwise you can pull it from the data passed to the setup() function
	 *
	 * @return false|Contact
	 */
	protected function get_the_contact() {
		return get_contactdata();
	}

	/**
	 * Check the sata against the settings to see if the conditions are satisfied.
	 *
	 * @return bool
	 */
	protected function can_complete_step() {
		return $this->get_setting( 'my_custom_setting' ) === $this->get_data( 'arg2' );
	}

}
