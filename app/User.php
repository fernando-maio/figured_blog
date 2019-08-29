<?php

namespace App;

use App\Components\ImageManagement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * Images path for users profile.
     *
     * @const IMG_PATH_PROFILE
     */
    const IMG_PATH_PROFILE = '/images/profiles/';

    /**
     * Connection database.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password',
        'photo_path',
        'biography',
        'admin',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * Create users
     * 
     * @var array $data
     * 
     * @return Users New User
     */
    public function createUser($data)
    {
        $imageManagement = new ImageManagement;
        $data['password'] = Hash::make($data['password']);
        $image = isset($data['photo_path']) ? $data['photo_path'] : null;
        if($image){
            $data['photo_path'] = $imageManagement->createImage($image, self::IMG_PATH_PROFILE);
        }

        return $this->create($data);
    }

    /**
     * Update user
     * 
     * @var integer $id
     * @var array $data
     * 
     * @return Users User updated
     */
    public function updateUser($id, $data)
    {
        $user = $this->find($id);
        $imageManagement = new ImageManagement;
        $image = isset($data['photo_path']) ? $data['photo_path'] : null;
        if($image){
            $data['photo_path'] = $imageManagement->createImage($image, self::IMG_PATH_PROFILE);
            $imageManagement->deleteImage($user->photo_path);        
        }

        return $user->update($data);
    }

    /**
     * Delete user
     * 
     * @var integer $id
     * 
     * @return bool|null
     */
    public function deleteUser($id)
    {
        $user = $this->find($id);
        $imageManagement = new ImageManagement;
        if(!empty($user->photo_path)){
            $imageManagement->deleteImage($user->photo_path);        
        }

        return $user->delete();
    }
}
