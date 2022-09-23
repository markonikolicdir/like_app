<?php

namespace Tests\Unit;

use DOMDocument;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider containsProvider
     */
    public function test_failure()
    {
        $this->assertContains(4, func_get_args());
    }

    public function testFailure1(): void
    {
        $this->assertStringContainsString('foo', 'foobar');
    }

    public function testFailure2(): void
    {
        $expected = new DOMDocument;
        $expected->loadXML('<foo><bar/></foo>');

        $actual = new DOMDocument;
        $actual->loadXML('<foo><bar/></foo>');

        $this->assertEquals($expected, $actual);
        $this->assertNotSame($expected, $actual);
    }

    public function containsProvider(): array
    {
        return [
            [15,8,4],
            [18,4,2]
        ];
    }
}
