<?php

namespace App\Validations;

use Validator;

/**
 * Validate input
 */
class DocumentValidation
{
	/**
	 * Validate input
	 * @param string $input
	 * @return boolean
	 */
	public function validateInput($input)
	{
		return Validator::make(
			$this->requestData($input),
			$this->rules(),
			$this->messages()
		);
	}

	/**
	 *
	 * @return array
	 */
	private function requestData($input)
	{
		$docId = preg_split("/\s+/", $input)[0];
		$tokens = trim(preg_replace('/[\t|\s{2,}]/', '', $input));

		return [
			'input' => $tokens,
			'doc_id' => $docId
		];
	}

	/**
	 *
	 * @return array
	 */
	private function rules()
	{
		return [
			'doc_id' => 'numeric',
			'input' => 'required|alpha_num'
		];
	}

	/**
	 *
	 * @return array
	 */
	private function messages()
	{
		return [
			'input.required' => 'Please provide an input for the index command',
			'input.alpha_num' => 'The input must contain numbers and letters',
			'doc_id.numeric' => 'The first character of the input must be a number'
		];
	}
}