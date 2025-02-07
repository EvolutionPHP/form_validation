<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionPHP\FormValidation\Lang;

class Language
{
	private $lang = [];
	public function __construct()
	{
		include __DIR__.DIRECTORY_SEPARATOR.'data.php';
		$this->lang = isset($lang) ? $lang : [];
	}
	public function set(array $lang)
	{
		$this->lang = array_merge($this->lang, $lang);
	}

	public function line($key)
	{
		return array_key_exists($key, $this->lang) ? $this->lang[$key] : false;
	}
}