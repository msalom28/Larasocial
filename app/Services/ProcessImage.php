<?php namespace App\Services;

use Faker\Factory as Faker;
use Image;

class ProcessImage
{	
	/**
	 * Save Image to the public folder
	 *
	 * @param $file, $path, $width, $height
	 *
	 * @return $filePath
	 */
	public function execute($file, $path, $width, $height)
	{
		$filename = $this->rename($file);
		Image::make($file)->resize($width, $height)->save($path.$filename);
		return asset('images/profileimages/'.$filename);
	}
	/**
	 * Rename image
	 *
	 * @param $file
	 *
	 * @return $filename
	 */
	public function rename($file)
	{
		$faker = Faker::create();
		 switch(exif_imagetype($file)) 
		 {
		 	case IMAGETYPE_GIF : return $faker->sha1.'.gif';
		 	break;
		 	case IMAGETYPE_JPEG : return $faker->sha1.'.jpg';
		 	break;
		 	case IMAGETYPE_PNG : return $faker->sha1.'.png';
		 	break;
		 	case IMAGETYPE_BMP : return $faker->sha1.'.bmp';
		 }
	
	}
}