<?php

namespace Model\Custom;

/**
 *
 * @author sandeepnarwal
 *        
 */
class File {
	
	/**
	 *
	 * @var unknown
	 */
	const ENTROPY = 'sha1';
	
	/**
	 *
	 * @var unknown
	 */
	const DOWNLOAD_AS_ZIP = "zip";
	
	/**
	 *
	 * @var unknown
	 */
	protected static $otherMimeType = array ("application/xml","text/xml");
	
	/**
	 *
	 * @var unknown
	 */
	protected static $xmlMimeType = array (
		"application/xml",
		"text/xml" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $pdfMimeType = array (
		"application/pdf" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $textMimeType = array (
		"text/plain" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $docMimeType = array (
		"application/vnd.openxmlformats-officedocument.wordprocessingml.document" 
	);
	// docx
	
	/**
	 *
	 * @var unknown
	 */
	protected static $xlsMimeType = array (
		"application/vnd.ms-excel",
		"application/xls",
		"application/x-xls",
		"application/x-excel",
		"application/x-ms-excel",
		"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $csvMimeType = array (
		"text/comma-separated-values",
		"text/csv",
		"application/csv" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $audioMimeType = array (
		"audio/x-pn-realaudio", // realaudio, .ra
		"audio/vnd.rn-realaudio" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $audioIosMimeType = array (
		"audio/3gpp", // 3gp, 3gpp
		"audio/3gpp2", // 3g2, 3gp2
		"audio/aiff", // aiff, aif, aifc, cdda
		"audio/x-aiff", // aiff, aif, aifc, cdda
		"audio/amr", // mp3, swa
		"audio/mp3", // mp3, swa
		"audio/mpeg3", // mp3, swa
		"audio/x-mp3", // mp3, swa
		"audio/x-mpeg3", // mp3, swa
		"audio/mp4", // mp4
		"audio/mpeg", // mpeg, mpg, mp3, swa
		"audio/x-mpeg", // mpeg, mpg, mp3, swa
		"audio/wav", // wav, bwf
		"audio/x-wav", // wav, bwf
		"audio/x-m4a", // m4a
		"audio/x-m4b", // m4b
		"audio/x-m4p" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $videoMimeType = array (
		"video/msvideo", // avi
		"video/avi", // avi
		"video/x-msvideo", // avi
		"video/mpeg" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $videoIosMimeType = array (
		"video/3gpp", // 3gp, 3gpp
		"video/3gpp2", // 3g2, 3gp2
		"video/mp4", // mp4
		"video/quicktime", // mov, qt, mqv
		"video/x-m4v" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $compressedMimeType = array (
		"application/x-bzip2",
		"application/x-gzip",
		"application/x-tar",
		"application/zip", // zip
		"application/x-compressed-zip", // zip
		"application/x-tar" 
	);
	
	/**
	 *
	 * @var unknown
	 */
	protected static $imageMimeType = array (
		"image/gif",
		"image/jpeg",
		"image/png",
		"image/tiff" 
	);
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getAllMime() {
		return array_merge ( self::$csvMimeType, self::$xmlMimeType, self::$xlsMimeType, self::$docMimeType, self::$pdfMimeType, self::$textMimeType, self::$audioIosMimeType, self::$audioMimeType, self::$compressedMimeType, self::$imageMimeType, self::$otherMimeType, self::$videoIosMimeType, self::$videoMimeType );
	}
	
	/**
	 * 
	 * @return multitype:
	 */
	public static function getOtherMime() {
		return array_merge ( self::$otherMimeType );
	}
	
	/**
	 * 
	 * @return multitype:
	 */
	public static function getXmlMime() {
		return array_merge ( self::$xmlMimeType );
	}
	
	/**
	 * 
	 * @return multitype:
	 */
	public static function getXlsMime() {
		return array_merge ( self::$xlsMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getCompressedMime() {
		return array_merge ( self::$compressedMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getPdfMime() {
		return array_merge ( self::$pdfMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getTextMime() {
		return array_merge ( self::$textMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getDocMime() {
		return array_merge ( self::$docMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getAudioMime() {
		return array_merge ( self::$audioIosMimeType, self::$audioMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getVideoMime() {
		return array_merge ( self::$videoIosMimeType, self::$videoMimeType );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public static function getImageMime() {
		return array_merge ( self::$imageMimeType );
	}
	
	/**
	 *
	 * @param unknown $file        	
	 * @param string $destination        	
	 * @return boolean|string
	 */
	public function save($file, $destination = 'uploads', $maxSizeAllowedInKb = 5000) {
		// must be a valid type before saving to disk !!
		
		/**
		 * if (! self::isAValidMimeType($file['tmp_name']))
		 */
		
		// this is alternate method, above is more secure,
		// but above is not working windows, its working on linux
		// so we keep below, unless we are sure of deployment server
		// above takes tmp_name but below takes type directory
		if (! self::isAValidMimeType_AlternateMethod ( $file ['type'] ))
			return false;
			
			// if image posted
		if ($file ['tmp_name']) {
			
			// get unique form php, entropy unique will make it more complex
			$name = uniqid ( '', true );
			$path = $file ['name'];
			$ext = pathinfo ( $path, PATHINFO_EXTENSION );
			
			$destination = DOC_ROOT . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $destination . DIRECTORY_SEPARATOR . $name . '.' . $ext;
			// if file actually uploaded to temp on server
			if (@move_uploaded_file ( $file ['tmp_name'], $destination )) {
				// change permission
				if (! chmod ( $destination, 0777 )) {
					return false;
				} else {
					return $destination;
				}
			}
		}
	}
	
	/**
	 * does not use zf2 class
	 * hust $_FILES['type'] and checks it
	 * not the best way to do !!
	 */
	public static function isAValidMimeType_AlternateMethod($fileType) {
		return in_array ( $fileType, self::getAllMime () );
	}
	
	/**
	 *
	 * @param unknown $file_path        	
	 * @return boolean
	 */
	public static function isAValidMimeType($file_path) {
		$fileType = new \Zend\Validator\File\MimeType ();
		$fileType->setMimeType ( self::getAllMime ( $file_path ) );
		if (! $fileType->isValid ( $file_path ))
			return false;
		return true;
	}
	
	/**
	 *
	 * @param unknown $fileType        	
	 * @return boolean
	 */
	public static function isAValidImage_AlternateMethod($fileType) {
		return in_array ( $fileType, self::getImageMime () );
	}
	
	/**
	 * generic method to get mime type from $_FILES['type']
	 * find it inside the array stack of this class else return unknown
	 */
	public static function getMimeType_AlternateMethod($fileType) {
		if (in_array ( $fileType, self::getAllMime () ))
			return $fileType;
		return 'unknown';
	}
	
	/**
	 *
	 * @param unknown $file_path        	
	 * @return string
	 */
	public static function getMimeType($file_path) {
		$mimes = self::getAllMime ();
		$MimeObject = new \Zend\Validator\File\MimeType ();
		foreach ( $mimes as $key => $value ) {
			$MimeObject->setMimeType ( $value );
			if ($MimeObject->isValid ( $file_path )) {
				return $value;
			}
		}
		
		return "unknown";
	
	/**
	 * old function logic
	 * $validator = new \Zend\Validator\File\IsCompressed();
	 * if ($validator->isValid($file_path)) {
	 * return 'zip';
	 * }
	 *
	 * $validator = new \Zend\Validator\File\IsImage();
	 * if ($validator->isValid($file_path)) {
	 * return 'image';
	 * }
	 *
	 * return 'unknown';
	 *
	 * end old function
	 */
	}
	
	/**
	 * this ia very basic version to convert RGB from CYMK
	 * we rather use an ICC profile to make this conversion cross platform
	 *
	 * @param unknown $file        	
	 * @return boolean
	 */
	public function convertToRgb($file) {
		// make sure Imagick is installed, else it will give error
		// only if file is an image
		try {
			$i = new \Imagick ( $file );
			$i->setImageColorspace ( \Imagick::COLORSPACE_SRGB );
			$i->writeImage ( $file );
			$i->destroy ();
		} catch ( \Exception $e ) {
			return false;
		}
		return true;
	}
	
	/**
	 *
	 * @param unknown $file_path        	
	 */
	public static function getHash($file_path) {
		// hash the content of file
		return hash_file ( self::ENTROPY, $file_path );
	}
	
	/**
	 *
	 * @param string $image_full_path        	
	 * @return multitype:
	 */
	public static function getImageDimensions($image_full_path = null) {
		
		// below is important, sql schema says it cannot be null
		$dimension = array (
			'width' => 0,
			'height' => 0 
		);
		
		if (@file_exists ( $image_full_path )) {
			$temp = getimagesize ( $image_full_path );
			$dimension ['width'] = $temp [0];
			$dimension ['height'] = $temp [1];
		}
		
		return $dimension;
	}
	
	/**
	 *
	 * @param unknown $img_width        	
	 * @param unknown $img_height        	
	 * @param unknown $max_width        	
	 * @param unknown $max_height        	
	 * @return multitype:unknown
	 */
	public static function getSmallerAspectRatioOfImage($img_width, $img_height, $max_width, $max_height) {
		
		// set the default, so that it only works when real image is larger then max
		$smallAspect = array (
			'height' => $img_height,
			'width' => $img_width 
		);
		
		// check if height is more then display cell
		if ($img_height > $max_height) {
			$fraction = ceil ( $img_height / $max_height );
			$new_height = $img_height / $fraction;
			$new_width = $img_width / $fraction;
			
			$smallAspect ['width'] = floor ( $new_width );
			$smallAspect ['height'] = floor ( $new_height );
		}
		
		// now check new width as well, it that is calculated more then display cell
		if ($smallAspect ['width'] > $max_width) {
			$fraction = ceil ( $smallAspect ['width'] / $max_width );
			$new_height = $smallAspect ['height'] / $fraction;
			$new_width = $smallAspect ['width'] / $fraction;
			
			$smallAspect ['width'] = floor ( $new_width );
			$smallAspect ['height'] = floor ( $new_height );
		}
		
		return $smallAspect;
	}
}

