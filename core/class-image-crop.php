<?php
/**
 *
 * @package Octagon Core
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if( ! class_exists( 'Octagon_Core_Resize' ) ) {

    class Octagon_Core_Exception extends Exception {}

    class Octagon_Core_Resize {

        static private $instance = null;

        public $thrown_error = false;

        private function __construct() {}

        private function __clone() {}

        static public function getInstance() {

            if( self::$instance == null ) {
                self::$instance = new self;
            }

            return self::$instance;

        }

        public function init( $url, $width = null, $height = null ) {
            try {
                // Validate inputs.
                if( ! $url ) {
                    throw new Octagon_Core_Exception( '$url parameter is required' );
                }
                if( ! $width ) {
                    throw new Octagon_Core_Exception( '$width parameter is required' );
                }

                // Define upload path & dir.
                $upload_info = wp_upload_dir();
                $upload_dir = $upload_info['basedir'];
                $upload_url = $upload_info['baseurl'];
                
                $http_prefix = "http://";
                $https_prefix = "https://";
                $relative_prefix = "//";

                if( ! strncmp( $url, $https_prefix, strlen( $https_prefix ) ) ) {
                    $upload_url = str_replace( $http_prefix, $https_prefix, $upload_url );
                }
                elseif( ! strncmp( $url, $http_prefix, strlen( $http_prefix ) ) ) {
                    $upload_url = str_replace( $https_prefix,$http_prefix, $upload_url );      
                }
                elseif( ! strncmp($url, $relative_prefix, strlen( $relative_prefix ) ) ) {
                    $upload_url = str_replace( array( 0 => "$http_prefix", 1 => "$https_prefix" ), $relative_prefix, $upload_url );
                }
                

                // Check if $img_url is local.
                if( false === strpos( $url, $upload_url ) ) {
                    throw new Octagon_Core_Exception( 'Image must be local: ' . $url );
                }

                // Define path of image.
                $rel_path = str_replace( $upload_url, '', $url );
                $img_path = $upload_dir . $rel_path;

                // Check if img path exists, and is an image indeed.
                if( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) {
                    throw new Octagon_Core_Exception( 'Image file does not exist (or is not an image): ' . $img_path );
                }

                // Get image info.
                $info = pathinfo( $img_path );
                $ext = $info['extension'];
                list( $orig_w, $orig_h ) = getimagesize( $img_path );

                // Get image size after cropping.
                $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, true );
                $dst_w = $dims[4];
                $dst_h = $dims[5];

                // Return the original image only if it exactly fits the needed measures.
                if( ! $dims || ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                    $img_url = $url;
                    $dst_w = $orig_w;
                    $dst_h = $orig_h;
                } else {
                    // Use this to check if cropped image already exists, so we can return that instead.
                    $suffix = "{$dst_w}x{$dst_h}";
                    $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                    $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                    if( ! $dims || ( $dst_w < $width || $dst_h < $height ) ) {
                        // Can't resize, so return false saying that the action to do could not be processed as planned.
                        throw new Octagon_Core_Exception( 'Unable to resize image because image_resize_dimensions() failed' );
                    }
                    // Else check if cache exists.
                    elseif( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                        $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                    }
                    // Else, we resize the image and return the new resized image url.
                    else {

                        $editor = wp_get_image_editor( $img_path );

                        if( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, true ) ) ) {
                            throw new Octagon_Core_Exception( 'Unable to get WP_Image_Editor: ' . $editor->get_error_message() . ' (is GD or ImageMagick installed?)' );
                        }

                        $resized_file = $editor->save();

                        if( ! is_wp_error( $resized_file ) ) {
                            $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                            $img_url = $upload_url . $resized_rel_path;
                        } else {
                            throw new Octagon_Core_Exception( 'Unable to save resized image file: ' . $editor->get_error_message() );
                        }

                    }
                }

                return $img_url;
            }
            catch( Octagon_Core_Exception $ex ) {
                error_log( 'Octagon_Core_Resize.process() error: ' . $ex->getMessage() );

                if( $this->thrown_error ) {
                    // Bubble up exception.
                    throw $ex;
                }
                else {
                    // Return false, so that this patch is backwards-compatible.
                    return false;
                }
            }
        }
    }
}

if( ! function_exists( 'octagon_crop' ) ) {

    /**
     * Image Crop Url
     *
     * @since  1.0
     * @param  string $url    Image Url
     * @param  int $width     Image Width
     * @param  int $height    Image Height
     * @return string
     */
    function octagon_crop( $url, $width = null, $height = null ) {

        // WPML fix
        if( defined( 'ICL_SITEPRESS_VERSION' ) ){
            global $sitepress;
            $url = $sitepress->convert_url( $url, $sitepress->get_default_language() );
        }

        $resize = Octagon_Core_Resize::getInstance();
        return $resize->init( $url, $width, $height );
    }
}


