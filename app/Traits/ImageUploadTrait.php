<?php

namespace App\Traits;

use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


trait ImageUploadTrait
{
  protected $image_path  = "app/public/images/covers";
  protected $img_height = 600;
  protected $img_width = 600;

  public function uploadImage($img)
  {


    $manager = new ImageManager(new Driver());
    $img_name = $this->imageName($img);
    $img = $manager->read($img);
    $img = $img->resize($this->img_width, $this->img_height);
    $img->save(storage_path($this->image_path . '/' . $img_name));

    return "images/covers/" . $img_name;
  }

  public function imageName($image)
  {
    return time() . '-' . $image->getClientOriginalName();
  }
}
