<?php

namespace Tests;

use Sasaya\Fuzzy;

class FuzzyTest extends TestCase
{
    /**
     * @dataProvider data
     */
    public function testMatch(string $haystack, bool $result)
    {
        $this->assertEquals(Fuzzy::match('abc', $haystack), $result);
    }

    public function testSearch()
    {
        $haystack = array_column($this->data(), 0);
        $result = array_column(array_filter($this->data(), function ($row) {
            return $row[1];
        }), 0);

        $this->assertEquals(Fuzzy::search('abc', $haystack), $result);
    }

    public function data(): array
    {
        return [
            ['abc', true],
            ['abcabc', true],
            ['abcabcabc', true],
            ['aabbcc', true],
            ['aaabbbccc', true],
            ['aabaca', true],
            ['acbccc', true],
            ['abbbcb', true],
            ['a.b.c.', true],
            ['aaa', false],
            ['bbb', false],
            ['ccc', false],
            ['ddd', false],
            ['cba', false],
            ['ccbbaa', false],
            ['cccbbbaaa', false],
        ];
    }
}
