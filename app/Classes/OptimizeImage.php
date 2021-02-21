<?php
namespace App\Classes;
use Image;

class OptimizeImage {
        public function run_optimizer($thumbnailUrl)
        {
            $img = Image::make($thumbnailUrl);
            $img->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
}
?>