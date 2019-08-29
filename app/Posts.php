<?php

namespace App;

use Auth;
use App\Components\ImageManagement;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /**
     * Images path for posts.
     *
     * @const IMG_PATH_POST
     */
    const IMG_PATH_POST = '/images/posts/';

    /**
     * Connection database.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'author',
        'views',
        'img_path',
        'category',
        'slug',
        'active'
    ];

    /**
     * Create post
     * 
     * @var array $data
     * 
     * @return Users New User
     */
    public function createPost($data)
    {
        $imageManagement = new ImageManagement;
        $image = isset($data['img_path']) ? $data['img_path'] : null;
        $data['author'] = Auth::user()->first_name . " " . Auth::user()->last_name;
        if($image){
            $data['img_path'] = $imageManagement->createImage($image, self::IMG_PATH_POST);
        }
        $slug = str_replace(' ', '_', $data['slug']);
        $data['slug'] = $slug;

        return $this->create($data);
    }

    /**
     * Update post
     * 
     * @var integer $id
     * @var array $data
     * 
     * @return Posts Post updated
     */
    public function updatePost($id, $data)
    {
        $post = $this->find($id);
        $imageManagement = new ImageManagement;
        $image = isset($data['img_path']) ? $data['img_path'] : null;
        if($image){
            $data['img_path'] = $imageManagement->createImage($image, self::IMG_PATH_POST);
            $imageManagement->deleteImage($post->img_path);
        }
        $slug = str_replace(' ', '_', $data['slug']);
        $data['slug'] = $slug;

        return $post->update($data);
    }

    /**
     * Delete post
     * 
     * @var integer $id
     * 
     * @return bool|null
     */
    public function deletePost($id)
    {
        $post = $this->find($id);
        $imageManagement = new ImageManagement;
        if(!empty($post->img_path)){
            $imageManagement->deleteImage($post->img_path);        
        }

        return $post->delete();
    }

    /**
     * Increment visualizations to post.
     *
     */
    public function incrementViews()
    {
        $views = array('views' => $this->views + 1);
        $this->update($views);
    }


    /**
     * List all posts using or not filters
     * 
     * @var string $filters
     * 
     * @return Posts Posts
     */
    public function listBlogPosts($filters)
    {
        if(!empty($filters['author']))
            return $this->where('active', '=', '1')->where('author', '=', $filters['author'])->orderBy('views', 'desc')->orderBy('title');

        if(!empty($filters['category']))
            return $this->where('active', '=', '1')->where('category', '=', $filters['category'])->orderBy('views', 'desc')->orderBy('title');

        if(!empty($filters['title']))
            return $this->where('active', '=', '1')->where('title', 'like', '%' . $filters['title'] . '%')->orderBy('views', 'desc')->orderBy('title');
            
        return $this->where('active', '=', '1')->orderBy('views', 'desc')->orderBy('title');
    }
}
