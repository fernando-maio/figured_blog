<?php

namespace App\Components;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserRegisterValidation
{
    /**
     * Validation users register
     * 
     * @param array $data Request values
     * 
     * @return Validator
     */
    public static function createUsersValidation(Request $data)
    {
        $rules = array(
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        );

        $messages = array(
	    	'first_name.required' => 'Insert name',
	    	'first_name.max' => 'First name must contains up to 255 characters',
	    	'last_name.required' => 'Insert last name',
	    	'last_name.max' => 'Last name must contains up to 255 characters',
	    	'email.required' => 'Insert email',
	    	'email.email' => 'Invalid email format',
	    	'email.max' => 'Max 255 characters',
	    	'email.unique' => 'Email already exists',
	    	'password.required' => 'Insert a password',
	    	'password.min' => 'The password must contain at least 6 characters',
	    	'password.confirmed' => 'Password and Confirm password values are different'
    	);

        return Validator::make($data->only('first_name', 'last_name', 'email', 'password', 'password_confirmation'), $rules, $messages);
    }

    /**
     * Validation users register
     * 
     * @param array $data Request values
     * 
     * @return Validator
     */
    public static function editUsersValidation(Request $data)
    {
        $rules = array(
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'
        );

        $messages = array(
	    	'first_name.required' => 'Insert name',
	    	'first_name.max' => 'First name must contains up to 255 characters',
	    	'last_name.required' => 'Insert last name',
	    	'last_name.max' => 'Last name must contains up to 255 characters'
    	);

        return Validator::make($data->only('first_name', 'last_name'), $rules, $messages);
    }
}