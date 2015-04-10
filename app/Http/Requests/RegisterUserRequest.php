<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'firstname'				=>	'required|min:2|alpha',
			'lastname'				=>	'required|min:2|alpha',
			'email'					=> 	'required|email|unique:users',
			'password'				=>	'required|confirmed|between:4,12',
			'password_confirmation'	=> 	'required',
			'gender'				=>	'required|alpha|size:1',
			'month'					=>	'required|numeric|between:01,12',
			'day'					=>	'required|numeric|between:01,31',			
			'year'					=>	'required|numeric|before:'.date('Y'),
			'profileimage'			=>	'required|image|mimes:jpeg,jpg,bmp,png,gif'
		];
	}

}
