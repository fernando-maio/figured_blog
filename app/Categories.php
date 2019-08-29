<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
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
        'name'
    ];

    /**
     * Update category
     * 
     * @var integer $id
     * @var array $data
     * 
     * @return Categories category updated
     */
    public function updateCategory($id, $data)
    {
        $category = $this->find($id);
        return $category->update($data);
    }

    /**
     * Delete category
     * 
     * @var integer $id
     * 
     * @return bool|null
     */
    public function deleteCategory($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
