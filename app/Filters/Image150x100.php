<?php
namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Image150x100 implements FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->resize(150, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

}