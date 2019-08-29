<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Categories;
use Illuminate\Http\Request;
use App\Components\PostRegisterValidation;

class PostController extends Controller
{
    /**
     * Post instance.
     *
     * @var $post
     */
    private $post;

    /**
     * Itens per page in pagination.
     *
     * @const PAGINATION
     */
    const PAGINATION = 10;

    /**
     * Inject Post
     */
    public function __construct(Posts $post)
    {
        $this->post = $post;
    }

    /**
     * List posts.
     *
     * @return Post $posts
     */
    public function index()
    {        
        $postsList = $this->post->orderBy('views')->orderBy('title');
        $posts = $postsList->paginate(self::PAGINATION);
        return view('admin.posts.index', array('posts' => $posts));
    }

    /**
     * New post form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $categoryModel = new Categories;
        $categories = $categoryModel->get();
        return view('admin.posts.create', array('categories' => $categories));
    }

    /**
     * Submit new post.
     *
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $validation = PostRegisterValidation::postValidation($request, true);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }

        $data = $request->all();
        
        if($this->post->createPost($data))
            return redirect()->route("posts.index")->with('status', 'Post created with success!');
        
        return redirect()->back()->withErrors('Error to create post. Please, try again!');
    }

    /**
     * Get data post.
     * 
     * @param integer $id Post ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $post = $this->post->find($id);
        $categoryModel = new Categories;
        $categories = $categoryModel->get();
        return view('admin.posts.edit', array('post' => $post, 'categories' => $categories));
    }

    /**
     * Edit post.
     *
     * @param  integer  $id
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postEdit($id, Request $request)
    {
        $data = $request->all();
        $validateSlug = ($data['prevSlug'] != $data['slug']) ? true : false;
        $validation = PostRegisterValidation::postValidation($request, $validateSlug);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }
        
        if($this->post->updatePost($id, $data))
            return redirect()->route("posts.index")->with('status', 'Post updated with success!');
        
        return redirect()->back()->withErrors('Error to update post. Please, try again!');
    }

    /**
     * Remove post.
     * 
     * @param integer $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getRemove($id)
    {
        if($this->post->deletePost($id))
            return redirect()->route("posts.index")->with('status', 'Post removed with success!');
        
        return redirect()->back()->withErrors('Error to remove post. Please, try again!');
    }
}
