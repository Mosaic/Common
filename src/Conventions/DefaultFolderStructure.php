<?php

namespace Mosaic\Common\Conventions;

class DefaultFolderStructure implements FolderStructureConvention
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
    }

    /**
     * @return string
     */
    public function basePath() : string
    {
        return $this->basePath;
    }

    /**
     * @return array
     */
    public function viewPaths() : array
    {
        return [
            $this->basePath . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views'
        ];
    }

    /**
     * @return string
     */
    public function storagePath() : string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'storage';
    }

    /**
     * @return string
     */
    public function viewCachePath() : string
    {
        return $this->storagePath() . DIRECTORY_SEPARATOR . 'views';
    }

    /**
     * @return string
     */
    public function cachePath() : string
    {
        return $this->storagePath() . DIRECTORY_SEPARATOR . 'cache';
    }
}
