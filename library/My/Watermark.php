<?php
/////////////////////////////////////////////////////////////////////////////////////////////
// @Author			: Subash P S
// @Titlte			: Thumanail and watermark generator
// @Created Date	: 13 Oct 2010
// @Modified Date	: 13 Oct 2010
// @Descrtion		: This is script for generating thumbnail for the uploaded image
//					  This is also generate watermark text on both uploaded image and thubnails.
// @Email			: <pssubashps@gmail.com>
// @version			: 1.0 alpha	
/////////////////////////////////////////////////////////////////////////////////////////////

class My_Watermark
{
	private $thumbHeight =75;
	private $thumbWidth =100;
	private $watermark = "Hello PHP";
	
	const FONT_SMALLER=10;
 	const FONT_SMALL=15;
 	const FONT_MEDIUM=20;
 	const FONT_LARGE=25;
 	const FONT_LARGER=30;

	function __construct()
	{

	}
	/*
	 * Description		: Creating Thumbnail
	 * @param1			: Filename
	 * @return			: false on failure,true on success
	 */
	function createThumb($filename)
	{
		if(!list($width, $height) = @getimagesize(IMG_UP_DIR."/".$filename))
		{
			return false;
		}
		
		$imageType = explode(".",$filename);
		$imageType = end($imageType);
		$thumb = imagecreatetruecolor($this->thumbWidth, $this->thumbHeight);
				
		switch($imageType)
		{
			case 'jpeg':
					$source = @imagecreatefromjpeg(IMG_UP_DIR."/".$filename);
					if(!$source)
					{
						return false;
					}
			break;
			
			case 'jpg':
					$source = @imagecreatefromjpeg(IMG_UP_DIR."/".$filename);
					if(!$source)
					{
						return false;
					}
			break;
			
			case 'png':
					$source = @imagecreatefrompng(IMG_UP_DIR."/".$filename);
					if(!$source)
					{
						return false;
					}
			break;
			
			case 'gif':
					$source = @imagecreatefromgif(IMG_UP_DIR."/".$filename);
					if(!$source)
					{
						return false;
					}
			break;
		}
		if(imagecopyresized($thumb, $source, 0, 0, 0, 0, $this->thumbWidth,$this->thumbHeight, $width, $height))
		{
			$thumName =IMG_UP_DIR."/".THUMB_DIR."/"."thumb_".$filename;
			switch($imageType)
			{
				case 'jpeg':
					if(imagejpeg($thumb,$thumName))
					{
						
					}
					else
					{
						return false;
					}
				break;
				
				case 'jpg':
					if(imagejpeg($thumb,$thumName))
					{
						
					}
					else
					{
						return false;
					}
				break;
				
				case 'png':
						if(imagepng($thumb,$thumName))
						{
							
						}
						else
						{
							return false;
						}
				break;
				
				case 'gif':
						if(imagegif($thumb,$thumName))
						{
							
						}
						else
						{
							return false;
						}
						
				break;
				default:
					return false;
			}
			
			chmod($thumName,0777);
			return true;
		}
		else
		{
			return false;
		}
		
		
	}
	function addWatermark($filename,$string="PHP")
	{
		$imageType = explode(".",$filename);
		$imageType = end($imageType);
		$size = @getimagesize($filename);
		if($size)
		{
			$width=$size[0];
			$height=$size[1];
			$fontSize=$this->getFontSize($width);
			$image_type=$this->getImageType($size['mime']);
			
			
			switch($imageType)
			{
				case 'jpeg':
					$waterMark = imagecreatefromjpeg($filename);
				break;
				
				case 'jpg':
					$waterMark = imagecreatefromjpeg($filename);
				break;
				
				case 'png':
						$waterMark = imagecreatefrompng($filename);
				break;
				
				case 'gif':
						$waterMark = imagecreatefromgif($filename);
				break;
			}
			
			$grey = imagecolorexactalpha($waterMark, 64, 64, 64, 10);
			if(imagettftext($waterMark, $fontSize,0,10,$height - 10,$grey, './fonts/font.ttf', $string))
			{
				
				switch($imageType)
				{
					case 'jpeg':
						imagejpeg($waterMark,$filename);
					break;
					
					case 'jpg':
						imagejpeg($waterMark,$filename);
					break;
					
					case 'png':
							imagepng($waterMark,$filename);
					break;
					
					case 'gif':
							imagegif($waterMark,$filename);
					break;
				}
			#imagedestroy($waterMark);

			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function getFontSize($IMsize){
 		
		
 		switch($IMsize){
 			case $IMsize<100:
 				
 				return self::FONT_SMALLER;
 				break;
 			case $IMsize<200:
 			
 				return self::FONT_SMALL;
 				break;
 			case $IMsize<400:
 				return self::FONT_MEDIUM;
 				break;
 			case $IMsize<1000:
 				return self::FONT_LARGE;
 				break;
 			default:
 			return self::FONT_LARGER;
 		
 		}
	}
	function getImageType($type){
 		$image_type=explode('/',$type);
 		return $image_type[1];
 	}
}
?>
