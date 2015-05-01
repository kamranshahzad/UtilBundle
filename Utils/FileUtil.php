<?php

namespace Cogilent\BaseBundle\Utils;

class FileUtil
{

    public function getFileSize($filename){
        $size = Files::getZipFilsize($filename);
        if($size<1024){
            $size = $size." bytes";
        }else if($size<(1024*1024)){
            $size=round($size/1024,0);
            $size = $size." KB";
        }else if($size<(1024*1024*1024)){
            $size=round($size/(1024*1024),0);
            $size = $size." MB";
        }else{
            $size=round($size/(1024*1024*1024),0);
            $size = $size." GB";
        }
        return $size;
    }

    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }


    public function absolutePath($path){

        $isEmptyPath    = (strlen($path) == 0);
        $isRelativePath = ($path{0} != '/');
        $isWindowsPath  = !(strpos($path, ':') === false);

        if (($isEmptyPath || $isRelativePath) && !$isWindowsPath)
            $path= getcwd().DIRECTORY_SEPARATOR.$path;

        // resolve path parts (single dot, double dot and double delimiters)
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $pathParts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutePathParts = array();
        foreach ($pathParts as $part) {
            if ($part == '.')
                continue;

            if ($part == '..') {
                array_pop($absolutePathParts);
            } else {
                $absolutePathParts[] = $part;
            }
        }
        $path = implode(DIRECTORY_SEPARATOR, $absolutePathParts);

        // resolve any symlinks
        if (file_exists($path) && linkinfo($path)>0)
            $path = readlink($path);

        // put initial separator that could have been lost
        $path= (!$isWindowsPath ? '/'.$path : $path);

        return $path;
    }

    public static function createImageDir($temp , $webDir){
        $fs = new Filesystem();
        try {
            $fs->mkdir( $webDir.'/upload/'. $temp );
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at ".$e->getPath();
        }
    }

    public static function getZipFilsize($filename) {
        $size = 0;
        $resource = zip_open($filename);
        while ($dir_resource = zip_read($resource)) {
            $size += zip_entry_filesize($dir_resource);
        }
        zip_close($resource);
        return $size;
    }




}//@