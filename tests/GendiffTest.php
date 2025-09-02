<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

// Импортируем функцию genDiff (если она в файлах src/)
// В зависимости от того, как у вас организованы функции
use function Hexlet\Code\genDiff;

class GendiffTest extends TestCase
{
    private string $fixturesPath;

    protected function setUp(): void
    {
        $this->fixturesPath = __DIR__ . '/fixtures';
    }

    public function testGendiff(): void
    {
        $file1 = $this->fixturesPath . '/file1.json';
        $file2 = $this->fixturesPath . '/file2.json';

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

        $result = genDiff($file1, $file2);
        $this->assertSame($expected, $result);
    }

    public function testGendiffWithNonExistentFiles(): void
    {
        $this->expectException(\Exception::class);
        genDiff('nonexistent1.json', 'nonexistent2.json');
    }

    public function testGendiffWithIdenticalFiles(): void
    {
        $file1 = $this->fixturesPath . '/file1.json';
        
        $result = genDiff($file1, $file1);
        
        // Для идентичных файлов все поля должны быть без изменений
        $this->assertStringContainsString('host: hexlet.io', $result);
        $this->assertStringNotContainsString('+', $result);
        $this->assertStringNotContainsString('-', $result);
    }
}
/*
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
}*/
