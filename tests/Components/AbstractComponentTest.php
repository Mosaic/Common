<?php

namespace Mosaic\Common\Tests\Components;

use Interop\Container\Definition\DefinitionProviderInterface;
use InvalidArgumentException;
use Mosaic\Common\Components\AbstractComponent;
use Mosaic\Common\Components\Component;

class AbstractComponentTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_use_some_default_implemenation()
    {
        $component = SomeComponent::impl();

        $this->assertEquals('impl', $component->getImplementation());
        $this->assertInstanceOf(Component::class, $component);
    }

    public function test_can_get_providers()
    {
        $component = SomeComponent::impl();

        $this->assertEquals([
            new StubProvider()
        ], $component->getProviders());
    }

    public function test_cannot_use_non_existing_implementation()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Implementation [non] does not exist');

        SomeComponent::non();
    }

    public function test_can_add_custom_implementations()
    {
        SomeComponent::extend('custom', function () {
            return [
                new StubProvider
            ];
        });

        $component = SomeComponent::custom();

        $this->assertEquals('custom', $component->getImplementation());
        $this->assertInstanceOf(Component::class, $component);

        $this->assertEquals([
            new StubProvider()
        ], $component->getProviders());
    }

    public function test_can_pass_arguments_to_component()
    {
        $component = SomeComponent::impl('foo', 'bar');

        $this->assertEquals([
            new StubProvider('foo', 'bar')
        ], $component->getProviders());
    }

    public function test_can_pass_arguments_to_custom_component()
    {
        SomeComponent::extend('custom', function ($foo, $bar) {
            $this->assertEquals('foo', $foo);
            $this->assertEquals('bar', $bar);
        });

        SomeComponent::custom('foo', 'bar');
    }
}

class SomeComponent extends AbstractComponent
{
    private $foo;
    private $bar;

    public function __construct($impl, $foo = null, $bar = null)
    {
        parent::__construct($impl);
        $this->foo = $foo;
        $this->bar = $bar;
    }

    public function resolveImpl()
    {
        return [
            new StubProvider($this->foo, $this->bar)
        ];
    }

    public function resolveCustom(callable $callback) : array
    {
        return $callback($this->foo, $this->bar);
    }
}

class StubProvider implements DefinitionProviderInterface
{
    public function getDefinitions()
    {
        return [];
    }
}
