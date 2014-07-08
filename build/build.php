<?php
/**
 * @version 1.0.0
 * @package Perfect Easy & Powerful Contact Form
 * @copyright © 2014 Perfect Web sp. z o.o., All rights reserved. http://www.perfect-web.co
 * @license Perfect Web License http://www.perfect-web.co/license
 * @author Piotr Moćko
 */

class PWebCompiler {

    protected $path = null;
    protected $zip = null;
    protected $is_pro = false;
    protected $excludeRegExps = array(
        '/^\./',
        '/^media\/cache\/.+\.((?!html).)+$/i',
        '/^media\/js\/jquery\.pwebcontact\.js$/i',
        '/^assets/i',
        '/^build/i'
    );
    protected $excludeProFiles = array(
        'uploader.php',
        'UploadHandler.php',
        'media/css/animations.css', // Modal window animations
        'media/css/uploader.css',
        'media/css/uploader-rtl.css',
        'media/jquery-ui', // jQuery UI Datapicker
        'media/js/jquery.cookie.js', // Auto-open counter
        'media/js/jquery.cookie.min.js', // Auto-open counter
        'media/js/jquery.fileupload.js',
        'media/js/jquery.fileupload.min.js',
        'media/js/jquery.fileupload-process.js',
        'media/js/jquery.fileupload-ui.js',
        'media/js/jquery.fileupload-validate.js',
        'media/js/jquery.iframe-transport.js', // fileupload
        'media/tickets'
    );
    protected $filterFiles = array(
        'pwebcontact.php',
        'tmpl/default.php'
    );
    
    protected function filterFileContents( &$contents = null ) {
        
        if ($this->is_pro) {
            $contents = preg_replace('/([^\n\r]*<!-- FREE START -->).*?(<!-- FREE END -->[^\n]*\n)/s', '', $contents);
            $contents = preg_replace('/([^\n\r]*\/\*\*\* FREE START \*\*\*\/).*?(\/\*\*\* FREE END \*\*\*\/[^\n]*\n)/s', '', $contents);
            
            $contents = preg_replace('/\n[^\n\r]*<!-- PRO (START|END) -->.*/', '', $contents);
            $contents = preg_replace('/\n[^\n\r]*\/\*\*\* PRO (START|END) \*\*\*\/.*/', '', $contents);
            
            $contents = preg_replace('/Plugin Name: [^\n\r]+/i', '\\0 PRO', $contents);
        }
        else {
            $contents = preg_replace('/([^\n\r]*<!-- PRO START -->).*?(<!-- PRO END -->[^\n]*\n)/s', '', $contents);
            $contents = preg_replace('/([^\n\r]*\/\*\*\* PRO START \*\*\*\/).*?(\/\*\*\* PRO END \*\*\*\/[^\n]*\n)/s', '', $contents);
            
            $contents = preg_replace('/\n[^\n\r]*<!-- FREE (START|END) -->.*/', '', $contents);
            $contents = preg_replace('/\n[^\n\r]*\/\*\*\* FREE (START|END) \*\*\*\/.*/', '', $contents);
        }
    }
    
    protected function addFilesToZip($directory = null) {
        
        if ($directory) {
            $directory = ltrim($directory, '/');
        }
        
        $iterator = new DirectoryIterator( $this->path . $directory );

        foreach ( $iterator as $info ) {
            
            if (!$info->isDot()) {
                
                $filename = $info->getFilename();
                
                foreach ($this->excludeRegExps as $regexp) {
                    if (preg_match($regexp, $directory . $filename)) {
                        continue 2;
                    }
                }
                
                if (!$this->is_pro AND in_array($directory . $filename, $this->excludeProFiles)) {
                    continue;
                }
                
                if ($info->isFile()) {
                    if (in_array($directory . $filename, $this->filterFiles)) {
                        $contents = file_get_contents( $this->path . $directory . $filename );
                        $this->filterFileContents( $contents );
                        $this->zip->addFromString( $this->zip_base_path . $directory . $filename, $contents );
                    }
                    else {
                        $this->zip->addFile( $this->path . $directory . $filename,  $this->zip_base_path . $directory . $filename );
                    }
                }
                elseif ($info->isDir()) {
                    $this->zip->addEmptyDir( $this->zip_base_path . $directory . $filename );
                    $this->addFilesToZip( $directory . $filename . '/' );
                }
            }
        }
    }
    
    protected function getVersion() {
        
        $contents = file_get_contents($this->path.'pwebcontact.php');
        
        if (preg_match('/Version: (\d+(\.\d+)*)+/i', $contents, $match)) {
            return $match[1];
        }
        
        return '1.0.0';
    }
    
    public function build() {
        
        $options = getopt('', array('pro'));
        
        $this->path = dirname(__DIR__).'/';
        
        $version = $this->getVersion();
        $this->is_pro = isset($options['pro']);
        
        $zip_path = $this->path . 'build/wp_pwebcontact_'.$version.'_'.($this->is_pro ? 'pro' : 'free').'.zip';
		
        if (is_file($zip_path)) {
            unlink($zip_path);
        }
        
        $this->zip = new ZipArchive;
		if (true === $this->zip->open($zip_path, ZipArchive::CREATE)) {
            
            $this->zip_base_path = 'pwebcontact/';
            $this->zip->addEmptyDir( $this->zip_base_path );
            
            $this->addFilesToZip();
            $this->zip->close();
		
            echo "OK\r\n";
		}
        else {
			echo $this->zip->getStatusString()."\r\n";
		}
    }
}

$complier = new PWebCompiler;
$complier->build();