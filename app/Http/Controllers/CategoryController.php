<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Components\CategoryRegisterValidation;

class CategoryController extends Controller
{
    /**
     * Category instance.
     *
     * @var $category
     */
    private $category;

    /**
     * Itens per page in pagination.
     *
     * @const PAGINATION
     */
    const PAGINATION = 10;

    /**
     * Inject Category
     */
    public function __construct(Categories $category)
    {
        $this->category = $category;
    }

    /**
     * List categories.
     *
     * @return Categories $categories
     */
    public function index()
    {
        $categoriesList = $this->category->orderBy('name');
        $categories = $categoriesList->paginate(self::PAGINATION);
        return view('admin.categories.index', array('categories' => $categories));
    }

    /**
     * New category form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('admin.categories.create');
    }

    /**
     * Submit new category.
     *
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $validation = CategoryRegisterValidation::categoriesValidation($request);
        
        if (!$validation->passes()) {
            return redirect()
                ->back()
                ->withErrors($validation)
                ->withInput();
        }

        $data = $request->all();
        
        if($this->category->create($data))
            return redirect()->route("categories.index")->with('status', 'Category created with success!');
        
        return redirect()->back()->withErrors('Error to create category. Please, try again!');
    }

    /**
     * Get data category.
     * 
     * @param integer $id category ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $category = $this->category->find($id);
        return view('admin.categories.edit', array('category' => $category));
    }

    /**
     * Edit category.
     *
     * @param  integer  $id
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postEdit($id, Request $request)
    {
        $validation = CategoryRegisterValidation::categoriesValidation($request);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }
        
        $data = $request->all();
        
        if($this->category->updateCategory($id, $data))
            return redirect()->route("categories.index")->with('status', 'Category updated with success!');
        
        return redirect()->back()->withErrors('Error to update category. Please, try again!');
    }

    /**
     * Remove category.
     * 
     * @param integer $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getRemove($id)
    {
        if($this->category->deleteCategory($id))
            return redirect()->route("categories.index")->with('status', 'Category removed with success!');
        
        return redirect()->back()->withErrors('Error to remove category. Please, try again!');
    }
}
