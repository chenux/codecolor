<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

	$style = "overflow: auto; padding: 5px; " .
			 "border: 1px solid #CCCCCC; " .
			 "background-color: #F4F4F4; " ;

	$containers = array (
		1 => 'div',
		'pre',
		'pre valid',
		'pre table',
		'none'
	);

	$settings->add(new admin_setting_configselect('filter_codecolor_container',
		get_string('container', 'filter_codecolor'),
		get_string('container_desc', 'filter_codecolor'), 2, $containers));

	$settings->add(new admin_setting_configtextarea('filter_codecolor_style',
		get_string('style', 'filter_codecolor'),
		get_string('style_desc', 'filter_codecolor'), $style));


	$lines = array (
		1 => 'Normal' , 
		'Fancy',
		'None'
	);

	$settings->add(new admin_setting_configselect('filter_codecolor_lines',
		get_string('lines', 'filter_codecolor'),
		get_string('lines_desc', 'filter_codecolor'), 3, $lines));

	$style = "color: #3f3f3f; ";


	$settings->add(new admin_setting_configtextarea('filter_codecolor_style_lines',
		get_string('style_lines', 'filter_codecolor'),
		get_string('style_lines_desc', 'filter_codecolor'), $style));


	$settings->add(new admin_setting_configcheckbox('filter_codecolor_class_on',
		get_string('style_class_on', 'filter_codecolor'),
		get_string('style_class_on_desc', 'filter_codecolor'), '0'));	


	$settings->add(new admin_setting_configtext('filter_codecolor_class_name',
		get_string('style_class_name', 'filter_codecolor'),
		get_string('style_class_name_desc', 'filter_codecolor'), 'geshi'));



}




