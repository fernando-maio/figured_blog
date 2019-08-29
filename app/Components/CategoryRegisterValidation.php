<?php

namespace App\Components;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryRegisterValidation
{
    /**
     * Validation categories register
     * 
     * @param array $data Request values
     * 
     * @return Validator
     */
    public static function categoriesValidation(Request $data)
    {
        $rules = array(
            'name' => 'required|min:2|max:255|unique:mysql.categories'
        );

        $messages = array(
	    	'name.required' => 'Insert name',
	    	'name.min' => 'The name must contain at least 2 characters',
	    	'name.max' => 'The name must contains up to 255 characters',
	    	'name.unique' => 'Category already exists'
    	);

        return Validator::make($data->all(), $rules, $messages);
    }
}