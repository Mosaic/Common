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
        $this->basePath = $basePath;
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
            $this->basePath . '/resources/views'
        ];
    }

    /**
     * @return string
     */
    public function viewCachePath() : string
    {
        return $this->basePath . '/storage/views';
    }

    /**
     * @return string
     */
    public function cachePath() : string
    {
        return $this->basePath . '/storage/cache';
    }
}
