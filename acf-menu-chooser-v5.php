<?php

defined( 'ABSPATH' ) || exit;

class acf_field_menu_chooser extends acf_field {


	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/

		$this->name = 'menu-chooser';


		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __( 'Menu Chooser', 'acf-menu-chooser' );


		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = 'choice';


		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/

		$this->defaults = [];


		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('menu-chooser', 'error');
		*/

		$this->l10n = [
			'error' => __( 'Error! Please enter a higher value', 'acf-menu-chooser' ),
		];

		/*
		 *  text to display in the default option when it's not required
		 */
		$this->no_choice_label = __( 'None', 'acf-menu-chooser' );
		/*
		 *  text to display in the default option when it's required
		 */
		$this->select_label = __( 'Select...', 'acf-menu-chooser' );

		// do not delete!
		parent::__construct();

	}


	function render_field_settings( $field ) {

		//Noting

	}


	function render_field( $field ) {

		$field_value = $field[ 'value' ];

		/**
		 * Filter the field value
		 *
		 * @param $field_value
		 */
		$field_value = apply_filters( 'acf_menu_chooser_field_value', $field_value );

		$field[ 'choices' ] = [];
		$menus              = wp_get_nav_menus();

		echo '<select name="' . $field[ 'name' ] . '" class="acf-menu-chooser">';
		// If there's no field value default to the first option
		$options = '';
		// Handle the default differently when the field is required for UX purposes
		if ( $field[ 'required' ] ) {
			$options .= '<option value="0" disabled>' . $this->select_label . '</option>';
		} else {
			$options .= '<option value="0" ' . selected( $field_value, 0,
					false ) . '>' . $this->no_choice_label . '</option>';
		}
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $choice ) {
				$field[ 'choices' ][ $choice->menu_id ] = $choice->term_id;
				$field[ 'choices' ][ $choice->name ]    = $choice->name;

				$options .= '<option  value="' . esc_attr( $field[ 'choices' ][ $choice->menu_id ] ) . '" ' . selected( $field_value,
						$field[ 'choices' ][ $choice->menu_id ],
						false ) . ' >' . esc_html( $field[ 'choices' ][ $choice->name ] ) . '</option>';
			}
		}
		/**
		 * Filter the options html. useful for adding custom options if needed
		 *
		 * @param string $options The select options
		 * @param string $field_value The selected value
		 */
		echo apply_filters( 'acf_menu_chooser_options_html', $options, $field_value );

		echo '</select>';

	}

}


// create field
new acf_field_menu_chooser();
