<?php

namespace App\Validations;

use Validator;

/**
 * Validate input
 */
class SearchValidation
{
	/**
	 * Validate input
	 * @param string $input
	 * @return boolean
	 */
	public function validateInput($input)
	{
		return Validator::make(
			$this->request($input),
			$this->rules($input),
			$this->messages()
		);
	}

	/**
	 *
	 * @return array
	 */
	private function request($input)
	{
		return [
			'input' => $input
		];
	}

	/**
	 *
	 * @return array
	 */
	private function rules($input)
	{
		$array = preg_split("/\s+/", $input);

		return [
			'input' => [(count($array) > 1) ? 'regex:/\((.*?)\)( .| &) ([a-zA-Z]*$)/' : 'regex:/[a-zA-Z]*/']
		];
	}

	/**
	 *
	 * @return array
	 */
	private function messages()
	{
		return [
			'input.regex' => 'The query expression is not valid. Valid expressions: a, (a | b) & c, (a & b) | c.',
		];
	}
}