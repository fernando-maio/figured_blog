<?php

namespace App\Components;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostRegisterValidation
{
    /**
     * Validation post register
     * 
     * @param array $data Request values
     * @param boolean $validateSlug 
     * 
     * @return Validator
     */
    public static function postValidation(Request $data, $validateSlug)
    {
        $dataPost = $data->only('title', 'category', 'slug', 'body');
        $slug = str_replace(' ', '_', $dataPost['slug']);
        $dataPost['slug'] = $slug;
        $rules = array(
            'title' => 'required|min:2|max:100',
            'category' => 'required',
            'body' => 'required|min:2|max:1000'
        );

        $messages = array(
	    	'title.required' => 'Insert title',
	    	'title.min' => 'The title must contain at least 2 characters',
	    	'title.max' => 'The title must contains up to 100 characters',
	    	'category.required' => 'Select a category',	    	
	    	'body.required' => 'Insert a post text',
	    	'body.min' => 'The post text must contain at least 2 characters',
	    	'body.max' => 'The post text must contains up to 10000 characters'
        );
        
        if($validateSlug){
            $rules['slug'] = 'required|min:2|max:15|unique:mysql.posts';
            $messages['slug.required'] = 'Insert a URL';
            $messages['slug.min'] = 'The URL must contain at least 2 characters';
            $messages['slug.max'] = 'The URL must contains up to 15 characters';
            $messages['slug.unique'] = 'URL already exists';
        }

        return Validator::make($dataPost, $rules, $messages);
    }
}