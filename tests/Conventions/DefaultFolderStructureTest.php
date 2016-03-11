<?php

namespace Mosaic\Common\Tests\Conventions;

use Mosaic\Common\Conventions\DefaultFolderStructure;

class DefaultFolderStructureTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultFolderStructure
     */
    protected $folder;

    public function setUp()
    {
        $this->folder = new DefaultFolderStructure('/base/');
    }

    public function test_can_get_base_path()
    {
        $this->assertEquals('/base', $this->folder->basePath());
    }

    public function test_can_get_view_paths()
    {
        $this->assertEquals([
            '/base/resources/views'
        ], $this->folder->viewPaths());
    }

    public function test_can_get_storage_path()
    {
        $this->assertEquals('/base/storage', $this->folder->storagePath());
    }

    public function test_can_get_view_cache_path()
    {
        $this->assertEquals('/base/storage/views', $this->folder->viewCachePath());
    }

    public function test_can_get_cache_path()
    {
        $this->assertEquals('/base/storage/cache', $this->folder->cachePath());
    }
}
