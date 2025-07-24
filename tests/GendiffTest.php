<?php

use PHPUnit\Framework\TestCase;

class GendiffTest extends TestCase
{
    public function testGendiff(): void
    {
        $file1 = __DIR__ . '/fixtures/file1.json';
        $file2 = __DIR__ . '/fixtures/file2.json';

        $expected = <<<EOT
{
  - follow: false
  host: hexlet.io
  - proxy: 123.234.53.22
  - timeout: 50
  + timeout: 20
  + verbose: true
}
EOT;

        $this->assertSame($expected, genDiff($file1, $file2));
    }
}
