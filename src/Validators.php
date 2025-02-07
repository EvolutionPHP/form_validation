<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionPHP\FormValidation;

class Validators
{
	/**
	 * Required
	 *
	 * @param	string
	 * @return	bool
	 */
	public function required($str)
	{
		if(is_null($str)){
			return false;
		}
		return is_array($str)
			? (empty($str) === FALSE)
			: (trim($str) !== '');
	}

	// --------------------------------------------------------------------

	/**
	 * Performs a Regular Expression match test.
	 *
	 * @param	string
	 * @param	string	regex
	 * @return	bool
	 */
	public function regex_match($str, $regex)
	{
		return (bool) preg_match($regex, $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @param	string	$str	string to compare against
	 * @param	string	$field
	 * @return	bool
	 */
	public function matches($str, $field, $is_POST=true)
	{
		if($is_POST){
			return isset($_POST[$field])
				? ($str === $_POST[$field])
				: FALSE;
		}else{
			return ($str === $field);
		}
	}

	/**
	 * Differs from another field
	 *
	 * @param	string
	 * @param	string	field
	 * @return	bool
	 */
	public function differs($str, $field, $is_POST=true)
	{
		if($is_POST){
			return ! (isset($_POST[$field]) && $_POST[$field] === $str);
		}

		return ($str !== $field);
	}

	// --------------------------------------------------------------------

	/**
	 * Minimum Length
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function min_length($str, $length)
	{
		if ( ! is_numeric($length))
		{
			return FALSE;
		}

		return ($length <= mb_strlen($str));
	}

	// --------------------------------------------------------------------

	/**
	 * Max Length
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function max_length($str, $length)
	{
		if ( ! is_numeric($length))
		{
			return FALSE;
		}

		return ($length >= mb_strlen($str));
	}

	// --------------------------------------------------------------------

	/**
	 * Exact Length
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function exact_length($str, $length)
	{
		if ( ! is_numeric($length))
		{
			return FALSE;
		}

		return (mb_strlen($str) === (int) $length);
	}

	// --------------------------------------------------------------------

	/**
	 * Valid URL
	 *
	 * @param	string	$str
	 * @return	bool
	 */
	public function valid_url($str)
	{
		if (empty($str))
		{
			return FALSE;
		}
		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Email
	 *
	 * @param	string
	 * @return	bool
	 */
	public function valid_email($str)
	{
		if (empty($str))
		{
			return FALSE;
		}
		return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Emails
	 *
	 * @param	string
	 * @return	bool
	 */
	public function valid_emails($str)
	{
		if (strpos($str, ',') === FALSE)
		{
			return $this->valid_email(trim($str));
		}

		foreach (explode(',', $str) as $email)
		{
			if (trim($email) !== '' && $this->valid_email(trim($email)) === FALSE)
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate IP Address
	 *
	 * @param	string
	 * @param	string	'ipv4' or 'ipv6' to validate a specific IP format
	 * @return	bool
	 */
	public function valid_ip($ip, $which = '')
	{
		switch (strtolower($which))
		{
			case 'ipv4':
				$which = FILTER_FLAG_IPV4;
				break;
			case 'ipv6':
				$which = FILTER_FLAG_IPV6;
				break;
			default:
				$which = FILTER_DEFAULT;
				break;
		}
		return (bool) filter_var($ip, FILTER_VALIDATE_IP, $which);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
		return ctype_alpha($str);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric($str)
	{
		return ctype_alnum((string) $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric w/ spaces
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric_spaces($str)
	{
		return (bool) preg_match('/^[A-Z0-9 ]+$/i', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		return (bool) preg_match('/^[a-z0-9_-]+$/i', $str);
	}



	// --------------------------------------------------------------------

	/**
	 * Numeric
	 *
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}

	// --------------------------------------------------------------------

	/**
	 * Integer
	 *
	 * @param	string
	 * @return	bool
	 */
	public function integer($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Decimal number
	 *
	 * @param	string
	 * @return	bool
	 */
	public function decimal($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Greater than
	 *
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	public function greater_than($str, $min)
	{
		return is_numeric($str) ? ($str > $min) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Equal to or Greater than
	 *
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	public function greater_than_equal_to($str, $min)
	{
		return is_numeric($str) ? ($str >= $min) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Less than
	 *
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	public function less_than($str, $max)
	{
		return is_numeric($str) ? ($str < $max) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Equal to or Less than
	 *
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	public function less_than_equal_to($str, $max)
	{
		return is_numeric($str) ? ($str <= $max) : FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Value should be within an array of values
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function in_list($value, $list)
	{
		return in_array($value, explode(',', $list), TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number  (0,1,2,3, etc.)
	 *
	 * @param	string
	 * @return	bool
	 */
	public function is_natural($str)
	{
		return ctype_digit((string) $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
	 * @param	string
	 * @return	bool
	 */
	public function is_natural_no_zero($str)
	{
		return ($str != 0 && ctype_digit((string) $str));
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Base64
	 *
	 * Tests a string for characters outside of the Base64 alphabet
	 * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
	 *
	 * @param	string
	 * @return	bool
	 */
	public function valid_base64($str)
	{
		return (base64_encode(base64_decode($str)) === $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Date Format Ex: $format = d/m/Y
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function valid_date($value, $format='d/m/Y')
	{
		$d = \DateTime::createFromFormat($format, $value);
		return $d && $d->format($format) === $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate JSON
	 *
	 * @param	string
	 * @return	bool
	 */
	function valid_json($str)
	{
		json_decode($str);
		return (json_last_error() === JSON_ERROR_NONE);
	}
	// --------------------------------------------------------------------

	/**
	 * Validate if file was uploaded
	 *
	 * @param	string
	 * @return	bool
	 */
	public function uploaded($str)
	{
		if(!isset($_FILES[$str])){
			echo $str.'<br>';
			return false;
		}
		$file = $_FILES[$str];
		return ($file['tmp_name'] != '');
	}

	// --------------------------------------------------------------------

	/**
	 * Max File Size Uploaded
	 *
	 * @param	string
	 * @return	bool
	 */
	public function max_size($str,$val)
	{
		$file_size = $_FILES[$str]['size'];
		$bytes = $val*1024;
		return ($bytes >= $file_size);
	}

	/**
	 * Check the file extension matches
	 *
	 * @param $str
	 * @param $param
	 * @return bool
	 */
	public function ext_in($str, $param)
	{
		$file_name = $_FILES[$str]['name'];
		$imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		return in_array($imageFileType, explode(',', $param));
	}

	/**
	 * Check the file mime matches
	 *
	 * @param $str
	 * @param $param
	 * @return bool
	 */
	public function mime_in($str, $param)
	{
		$file_type = $_FILES[$str]['type'];
		return in_array($file_type, explode(',', $param));
	}


	/**
	 * File is image
	 * @return bool
	 */
	public function is_image($str)
	{
		$file_type = $_FILES[$str]['type'];
		// IE will sometimes return odd mime-types during upload, so here we just standardize all
		// jpegs or pngs to the same file type.

		$png_mimes  = array('image/x-png');
		$jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');

		if (in_array($file_type, $png_mimes))
		{
			$this->file_type = 'image/png';
		}
		elseif (in_array($file_type, $jpeg_mimes))
		{
			$this->file_type = 'image/jpeg';
		}

		$img_mimes = array('image/gif',	'image/jpeg', 'image/png','image/webp','image/svg+xml');

		return in_array($file_type, $img_mimes, TRUE);
	}

	/**
	 * Define max image dimensions (params: width,height)
	 *
	 * @param $str
	 * @param $val
	 * @return bool
	 */
	public function max_dims($str, $params)
	{
		if(!$this->is_image($str)){
			return false;
		}
		if(!$dimensions = $this->image_dimensions($str)){
			return true;
		}
		$dim = explode(',', $params);
		if ($dim[0] > 0 && $dimensions[0] > $dim[0])
		{
			return FALSE;
		}
		if ($dim[1] > 0 && $dimensions[1] > $dim[1])
		{
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Define minimum image dimensions (params: width,height)
	 *
	 * @param $str
	 * @param $val
	 * @return bool
	 */
	public function min_dims($str, $params)
	{
		if(!$this->is_image($str)){
			return false;
		}
		if(!$dimensions = $this->image_dimensions($str)){
			return true;
		}
		$dim = explode(',', $params);

		if ($dim[0] > 0 && $dimensions[0] < $dim[0])
		{
			return FALSE;
		}

		if ($dim[1] > 0 && $dimensions[1] < $dim[1])
		{
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Define exact image dimensions (params: width,height)
	 *
	 * @param $str
	 * @param $val
	 * @return bool
	 */
	public function exact_dims($str, $params)
	{
		if(!$this->is_image($str)){
			return false;
		}
		if(!$dimensions = $this->image_dimensions($str)){
			return true;
		}
		$dim = explode(',', $params);

		if ($dimensions[0] != $dim[0])
		{
			return FALSE;
		}

		if ($dimensions[1] != $dim[1])
		{
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Image dimensions
	 * @param $str
	 * @return array|null
	 */
	protected function image_dimensions($str)
	{
		if (function_exists('getimagesize'))
		{
			$D = @getimagesize($_FILES[$str]["tmp_name"]);
			return $D;
		}
		return null;
	}
}