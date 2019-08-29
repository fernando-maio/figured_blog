<?php

namespace App\Components;

use Illuminate\Support\Facades\File;

class ImageManagement
{
    public function createImage($image, $path)
    {
        $dataPath = null;

        if(!empty($image)){
            $extension = $image->getClientOriginalExtension();
            $hash = md5(uniqid(rand(), true));
            $imageName = $hash.".".$extension;
            $destinationPath = public_path().$path;
            $upload_success = $image->move($destinationPath, $imageName);
            $dataPath = $path.$imageName;
        }
        
        return $dataPath;
    }

    public function deleteImage($image)
    {
        if(File::isFile(public_path().$image)){
            File::delete(public_path().$image);
        }
    }

}