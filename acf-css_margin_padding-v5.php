<?php

class acf_field_css_margin_padding extends acf_field {
	
	
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
		
		$this->name = 'css_margin_padding';
		
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __('CSS Margin & Padding Settings', 'acf-css_margin_padding');
		
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'layout';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
		);
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('css_margin_padding', 'error');
		*/
		
		$this->l10n = array(
			'none'		=> __('None', 'acf-css_margin_padding'),
			'solid'		=> __('Solid', 'acf-css_margin_padding'),
			'dashed'	=> __('Dashed', 'acf-css_margin_padding'),
			'dotted'	=> __('Dotted', 'acf-css_margin_padding'),
			'double'	=> __('Double', 'acf-css_margin_padding'),
			'groove'	=> __('Groove', 'acf-css_margin_padding'),
			'ridge'		=> __('Ridge', 'acf-css_margin_padding'),
			'inset'		=> __('Inset', 'acf-css_margin_padding'),
			'outset'	=> __('Outset', 'acf-css_margin_padding'),
			'nostyle'	=> __('No matching style found', 'acf-css_margin_padding'),
		);
		
		
		add_action( 'admin_enqueue_scripts', 'wptuts_add_color_picker' );
		function wptuts_add_color_picker( $hook ) {
		 
		if( is_admin() ) {
		 
		        // Add the color picker css file
		    wp_enqueue_style( 'wp-color-picker' );
		 
		        // Include our custom jQuery file with WordPress Color Picker dependency
		        wp_enqueue_script( 'custom-script-handle', plugins_url( 'js/input.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		    }
		}

		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/		
		

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {

		$dir = plugin_dir_url( __FILE__ );

		/*
		*  Review the data of $field.
		*  This will show what data is available
		*/
		// convert value to array
		$field['value'] = dhz_get_array($field['value']);

		$fieldname = str_replace(
			array(
				'][',
				'[',
				']'
			),
			array(
				'_',
				'_',
				''
			),
			$field['name']
		);		

		if ( empty($field['value']) ) {
			$field['value']['margin']						= "0px 0px 0px 0px";
			$field['value']['margin-top']					= "0px";
			$field['value']['margin-right']					= "0px";
			$field['value']['margin-bottom']				= "0px";
			$field['value']['margin-left']					= "0px";
			
			$field['value']['padding']						= "0px 0px 0px 0px";
			$field['value']['padding-top']					= "0px";
			$field['value']['padding-right']				= "0px";
			$field['value']['padding-bottom']				= "0px";
			$field['value']['padding-left']					= "0px";
			
		
		}
		
		$field_value = $field['value'];
		?>

		<input
			type = "hidden"
			class = "acf-css-margin acf-css-margin-shorthand css-layout-input"
			name = "<?php echo $field['name']; ?>[margin]"
			id = "<?php echo $fieldname; ?>_margin"
			value = "<?php echo $field_value['margin']; ?>"
			data-fieldname = "<?php echo $field['name']; ?>"
		>
	
		<input
			type = "hidden"
			class = "acf-css-padding acf-css-padding-shorthand css-layout-input"
			name = "<?php echo $field['name']; ?>[padding]"
			id = "<?php echo $fieldname; ?>_padding"
			value = "<?php echo $field_value['padding']; ?>"
			data-fieldname = "<?php echo $field['name']; ?>"
		>
		
		<div class="container acf-container-css_layout">
			<div class="infotext">
				<p><?php _e('Note, that if you enter a value without a unit, the default unit <em>px</em> will automatically appended. If an invalid value is entered, it is replaced by the default value <em>0px</em>. Accepted units are: <em>px</em>, <em>%</em> and <em>em</em></p><p>Activate the lock <span class="dashicons dashicons-lock acf-css-checkall" style="margin:0"></span> to link all values.', 'acf-css_margin_padding'); ?><p>
			</div>
			<div class="acf-border-settings">

					<div class="paddings">
					<label><?php _e('Padding Desktop / Padding Mobile', 'acf-css_margin_padding'); ?> <span class="dashicons dashicons-lock acf-css-checkall acf-border-radius-checkall" data-fieldname="<?php echo $field['name']; ?>"></span></label>
					<div class="content">
							<div class="left_col">
						
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding top', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-top css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-top]"
								id = "<?php echo $fieldname ?>_padding-top"
								value = "<?php echo $field_value['padding-top'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "1"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding right', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-right css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-right]"
								id = "<?php echo $fieldname ?>_padding-right"
								value = "<?php echo $field_value['padding-right'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "2"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding bottom', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-bottom css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-bottom]"
								id = "<?php echo $fieldname ?>_padding-bottom"
								value = "<?php echo $field_value['padding-bottom'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "3"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding left', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-left css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-left]"
								id = "<?php echo $fieldname ?>_padding-left"
								value = "<?php echo $field_value['padding-left'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "4"
							>
						</div>
						<div class="right_col">
							<label for= "<?php echo $fieldname; ?>_padding-top-mobile"><?php _e('padding top mobile', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-top css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-top]"
								id = "<?php echo $fieldname ?>_padding-top"
								value = "<?php echo $field_value['padding-top'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "1"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding right mobile', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-right css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-right]"
								id = "<?php echo $fieldname ?>_padding-right"
								value = "<?php echo $field_value['padding-right'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "2"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding bottom mobile', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-bottom css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-bottom]"
								id = "<?php echo $fieldname ?>_padding-bottom"
								value = "<?php echo $field_value['padding-bottom'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "3"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_padding-top-desktop"><?php _e('padding left mobile', 'acf-css_padding_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-padding acf-css-padding-left css-layout-input"
								name = "<?php echo $field['name'] ?>[padding-left]"
								id = "<?php echo $fieldname ?>_padding-left"
								value = "<?php echo $field_value['padding-left'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "4"
							>
						</div>
					</div>
					
					</div>
					<div class="margins">
						<label><?php _e('Margin Desktop / Margin Mobile', 'acf-css_margin_padding'); ?> <span class="dashicons dashicons-lock acf-css-checkall acf-border-radius-checkall" data-fieldname="<?php echo $field['name']; ?>"></span></label>
						<div class="content">
							<div class="left_col">
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin top', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-top css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-top]"
								id = "<?php echo $fieldname ?>_margin-top"
								value = "<?php echo $field_value['margin-top'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "1"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin right', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-right css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-right]"
								id = "<?php echo $fieldname ?>_margin-right"
								value = "<?php echo $field_value['margin-right'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "2"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin bottom', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-bottom css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-bottom]"
								id = "<?php echo $fieldname ?>_margin-bottom"
								value = "<?php echo $field_value['margin-bottom'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "3"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin left', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-left css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-left]"
								id = "<?php echo $fieldname ?>_margin-left"
								value = "<?php echo $field_value['margin-left'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "4"
							>
						</div>
						<div class="right_col">
							<label for= "<?php echo $fieldname; ?>_margin-top-mobile"><?php _e('margin top mobile', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-top css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-top]"
								id = "<?php echo $fieldname ?>_margin-top"
								value = "<?php echo $field_value['margin-top'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "1"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin right', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-right css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-right]"
								id = "<?php echo $fieldname ?>_margin-right"
								value = "<?php echo $field_value['margin-right'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "2"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin bottom', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-bottom css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-bottom]"
								id = "<?php echo $fieldname ?>_margin-bottom"
								value = "<?php echo $field_value['margin-bottom'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "3"
							>
							<div class="clear"></div>
							<label for= "<?php echo $fieldname; ?>_margin-top-desktop"><?php _e('margin left', 'acf-css_margin_padding'); ?></label>
							<input
								type = "text"
								class = "acf-css-margin acf-css-margin-left css-layout-input"
								name = "<?php echo $field['name'] ?>[margin-left]"
								id = "<?php echo $fieldname ?>_margin-left"
								value = "<?php echo $field_value['margin-left'] ?>"
								data-fieldname = "<?php echo $field['name']; ?>"
								tabindex = "4"
							>
						</div>
						</div>
						
					</div>
			</div>
		</div>
	<?php }
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/	
	
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );
		
		
		// register & include JS
		// wp_register_script( 'acf-input-css_margin_padding', "{$dir}js/input.js" );
		// wp_enqueue_script('acf-input-css_margin_padding');
		
		
		// register & include CSS
		wp_register_style( 'acf-input-css_margin_padding', "{$dir}css/input.css" );
		wp_enqueue_style('acf-input-css_margin_padding');
		
		
	}

	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	
	
	function update_value( $value, $post_id, $field ) {
		
		$value['border'] = $value['border-top'] . ' ' . $value['border-style'] . ' ' . $value['border-color'];

		return $value;
		
	}	
	
	
}

function dhz_get_array( $var = false, $delimiter = ',' ) {
	
	// is array?
	if( is_array($var) ) {
	
		return $var;
	
	}
	
	
	// bail early if empty
	if( empty($var) && !is_numeric($var) ) {
		
		return array();
		
	}
	
	
	// string 
	if( is_string($var) && $delimiter ) {
		
		return explode($delimiter, $var);
		
	}
	
	
	// place in array
	return array( $var );
	
}


// create field
new acf_field_css_margin_padding();

?>
