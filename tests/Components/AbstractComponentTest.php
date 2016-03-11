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
}

class SomeComponent extends AbstractComponent
{
    public function resolveImpl()
    {
        return [
            new StubProvider
        ];
    }

    public function resolveCustom(callable $callback) : array
    {
        return $callback();
    }
}

class StubProvider implements DefinitionProviderInterface
{
    public function getDefinitions()
    {
        return [];
    }
}
