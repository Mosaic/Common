<?php

namespace Mosaic\Common\Tests;

use Mosaic\Common\HtmlString;

class HtmlStringTest extends \PHPUnit_Framework_TestCase
{
    public function test_html_string_is_stringable()
    {
        $this->assertEquals('string', (string) new HtmlString('string'));
    }
}
