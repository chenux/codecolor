<?php

defined('MOODLE_INTERNAL') || die();


class filter_codecolor extends moodle_text_filter {

	function filter($input, array $options = array()) {


		preg_match_all('/<pre\s*?class="code-(.*?)".*?>(.*?)<\/pre>/s', $input, $matches);

		// $matches[0] - All.
		// $matches[1] - Language.
		// $matches[2] - source.

		if ( count($matches) ) {
			for($i = 0; $i < count($matches[0]); $i++) {
					$out = $this->highlight($matches[2][$i], $matches[1][$i]);
					// echo $out;
					$input = str_replace($matches[0][$i], $out, $input);
			}
		}

		//return $input .  "<pre>" . print_r($matches, true) . "</pre>";
		return $input;
	}



	function highlight($source, $language) {


		global $CFG;

		require_once("$CFG->dirroot/filter/codecolor/geshi.php");


		if ('html' == $language) {
			$language = 'html4strict';
		}

		$source = str_replace(
			array('&lt;', '&gt;', '&amp;', '<br />', '&nbsp;'),
			array('<',    '>',    '&',     '', ' '),
		$source);

		$geshi = new GeSHi(trim($source), $language);

		// Type of container.
		$type_container = array (
			1 => GESHI_HEADER_DIV ,
			GESHI_HEADER_PRE,
			GESHI_HEADER_PRE_VALID,
			GESHI_HEADER_PRE_TABLE,
			GESHI_HEADER_NONE
		);

		$geshi->set_header_type($type_container[intval($CFG->filter_codecolor_container)]);

		// Line Numbers
		$style_lines = array (
			1 => GESHI_NORMAL_LINE_NUMBERS ,
			GESHI_FANCY_LINE_NUMBERS,
			GESHI_NO_LINE_NUMBERS
		);

		$geshi->enable_line_numbers($style_lines[intval($CFG->filter_codecolor_lines)]);


		if ($CFG->filter_codecolor_class_on) {
			$this->custom_theme($geshi);
		} else {
			$this->style_theme($geshi);
		}

		return $geshi->parse_code();

	}

	public function style_theme($geshi)
	{
		global $CFG;

		// Style of container.
		$geshi->set_overall_style($CFG->filter_codecolor_style);

		// Style of lines numbers.
		$geshi->set_line_style($CFG->filter_codecolor_style_lines, true);

	}

	function custom_theme($geshi) {

		global $CFG;

		// Class on.
		$geshi->enable_classes(true);

		// Class name.
		$geshi->set_overall_class($CFG->filter_codecolor_class_name);

	}



}