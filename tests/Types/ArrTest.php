<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_arr()
    {
        $this->assertInstanceOf(Arr::class, Arr::from(['host' => 'github.com']));
        $this->assertEquals(['host' => 'github.com'], Arr::from(['host' => 'github.com'])->getValue());
        $this->assertEquals('{"host":"github.com"}', (string)Arr::from(['host' => 'github.com']));
        $this->assertEquals(null, Arr::innFrom(null));
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_arr_from_json_string()
    {
        $this->assertEquals(['host' => 'github.com'], Arr::fromJson('{"host":"github.com"}')->getValue());
        $this->assertEquals('{"host":"github.com"}', Arr::fromJson('{"host":"github.com"}')->toJson());
        $this->assertEquals(null, Arr::innFromJson(null));
        $this->assertEquals(true, Arr::isValidJsonString('{"host":"github.com"}'));
        $this->assertEquals(false, Arr::isValidJsonString('"host":"github.com"'));
    }
}
