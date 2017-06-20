<?php
require_once get_template_directory() . '/includes/options-config.php';
	if( ! class_exists('Primal_Customizer_API_Wrapper') ) {
			require_once get_template_directory() . '/admin/class.primal-customizer-api-wrapper.php';
	}


Primal_Customizer_API_Wrapper::getInstance($options);
