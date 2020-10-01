<?php

use Illuminate\Validation\Factory;
use MadeITBelgium\Domainbox\Validation\ValidatorExtensions;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testValidatorDomainnameTrue()
    {
        $validator = new MadeITBelgium\Domainbox\Validation\Validator();
        $this->assertTrue($validator->isDomainname('madeit.be'));
    }

    public function testValidatorDomainnameFalse()
    {
        $validator = new MadeITBelgium\Domainbox\Validation\Validator();
        $this->assertFalse($validator->isDomainname('madeit.belgium'));
    }

    public function testValidDomainname()
    {
        $validator = Mockery::mock('MadeITBelgium\Domainbox\Validation\Validator');
        $extensions = new ValidatorExtensions($validator);
        $container = Mockery::mock('Illuminate\Container\Container');
        $translator = Mockery::mock('Illuminate\Contracts\Translation\Translator');
        $container->shouldReceive('make')->once()->with('MadeITBelgium\Domainbox\Validation\ValidatorExtensions')->andReturn($extensions);
        $validator->shouldReceive('isDomainname')->once()->with('madeit.be')->andReturn(true);
        $factory = new Factory($translator, $container);
        $factory->extend('domainname', 'MadeITBelgium\Domainbox\Validation\ValidatorExtensions@validateDomainname', ':attribute must be a valid Domainname');
        $validator = $factory->make(['foo' => 'madeit.be'], ['foo' => 'domainname']);
        $this->assertTrue($validator->passes());
    }

    public function testValidDomainnameFails()
    {
        $validator = Mockery::mock('MadeITBelgium\Domainbox\Validation\Validator');
        $extensions = new ValidatorExtensions($validator);
        $container = Mockery::mock('Illuminate\Container\Container');
        $translator = Mockery::mock('Illuminate\Contracts\Translation\Translator');
        $container->shouldReceive('make')->once()->with('MadeITBelgium\Domainbox\Validation\ValidatorExtensions')->andReturn($extensions);
        $validator->shouldReceive('isDomainname')->once()->with('madeit.belgium')->andReturn(false);
        $translator->shouldReceive('get')->once()->with('validation.custom')->andReturn('validation.custom');
        $translator->shouldReceive('get')->once()->with('validation.custom.foo.domainname')->andReturn('validation.custom.foo.domainname');
        $translator->shouldReceive('get')->once()->with('validation.domainname')->andReturn('validation.domainname');
        $translator->shouldReceive('get')->once()->with('validation.attributes')->andReturn('validation.attributes');
        $translator->shouldReceive('get')->once()->with('validation.attributes.foo')->andReturn('validation.attributes.foo');
        $translator->shouldReceive('get')->once()->with('validation.values.foo.madeit.belgium')->andReturn('validation.values.foo.madeit.belgium');

        $factory = new Factory($translator, $container);
        $factory->extend('domainname', 'MadeITBelgium\Domainbox\Validation\ValidatorExtensions@validateDomainname', ':attribute must be a valid Domainname');
        $validator = $factory->make(['foo' => 'madeit.belgium'], ['foo' => 'domainname']);
        $this->assertTrue($validator->fails());
        $messages = $validator->messages();
        $this->assertInstanceOf('Illuminate\Support\MessageBag', $messages);
        $this->assertEquals('foo must be a valid Domainname', $messages->first('foo'));
    }
}
