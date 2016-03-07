<?php

namespace Mosaic\Common\Conventions;

interface FolderStructureConvention
{
    /**
     * @return string
     */
    public function basePath() : string;

    /**
     * @return array
     */
    public function viewPaths() : array;

    /**
     * @return string
     */
    public function viewCachePath() : string;

    /**
     * @return string
     */
    public function cachePath() : string;
}
