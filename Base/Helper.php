<?php
namespace Kamran\UtilBundle\Base;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Helper{

    private $container;
    public $webDir1;
    public $webDir2;
    public $fileLoc;
    public $logDir;
    public $rootDir;

    public function __construct( ContainerInterface $_container ){
        $this->container = $_container;
        $this->fileLoc   = $this->container->get('file_locator');
        $this->webDir1   = realpath($this->container->get('kernel')->getRootDir() . '/../web');
        $this->webDir2   = $this->container->get('kernel')->getRootDir() . '/../web';
        $this->logDir    = $this->container->get('kernel')->getLogDir();
        $this->rootDir   = $this->container->get('kernel')->getRootDir();
        //$path = $fileLocator->locate('@MyBundle/path/to/file.txt')
    }

}//@