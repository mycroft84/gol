<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'alpha'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('onlyLetter'),
	'alpha_dash'    => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('onlyLetterAndDash'),
	'alpha_numeric' => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('onlyLetterAndNumber'),
	'color'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustColor'),
	'credit_card'   => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustCreditCard'),
	'date'          => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustDate'),
	'decimal'       => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustDecimal'),
	'digit'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustDigit'),
	'email'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustEmail'),
	'email_domain'  => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustEmailDomain'),
	'equals'        => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustEquals'),
	'exact_length'  => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('exactLength'),
	'in_array'      => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('inArray'),
	'ip'            => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustIp'),
	'matches'       => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustMatch'),
	'min_length'    => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('minLength'),
	'max_length'    => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('maxLength'),
	'not_empty'     => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('notEmpty'),
	'not_empty_select'     => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('notEmpty'),
	'numeric'       => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustNumeric'),
	'phone'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustPhone'),
	'range'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustRange'),
	'regex'         => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustRegEx'),
	'url'           => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('mustUrl'),
	'Upload::type'	=> "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('notAllowedType'),
	'Upload::not_empty' => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('notEmpty'),
	'Upload::size' => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('notAllowedSize'),
    
	'Model_Admin::uniqueEmailAdmin' => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('uniqueEmailAdmin'),
	'Model_Admin::uniqueEmailAdmin' => "'<span class='fieldName'>:field</span>' ".Kohana::subtitles('uniqueEmailAdmin'),
);