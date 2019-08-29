<?php

namespace App\Http\Controllers;

use App\User;
use App\Posts;
use App\Categories;
use Illuminate\Http\Request;

class PageController extends Controller
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
    const PAGINATION = 5;

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
    public function index(Request $request)
    {
        $filters = $request->all();
        $users = User::select('first_name', 'last_name')->get();
        $categories = Categories::select('name')->get();
        $postsList = $this->post->listBlogPosts($filters);
        $posts = $postsList->paginate(self::PAGINATION);
        return view('pages.posts.index', array('posts' => $posts, 'users' => $users, 'categories' => $categories));
    }

    /**
     * Get single post.
     * 
     * @param string $slug Post slug
     * 
     * @return \Illuminate\Http\Response
     */
    public function blogPostSingle($slug)
    {
        $post = $this->post->where('slug', $slug)->first();
        $post->incrementViews();
        return view('pages.posts.single', array('post' => $post));
    }
}
