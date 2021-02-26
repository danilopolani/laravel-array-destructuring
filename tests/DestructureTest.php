<?php

namespace Danilopolani\ArrayDestructuring\Tests;

use Illuminate\Support\Arr;

class DestructureTest extends TestCase
{
    protected static array $post = [
        'title' => 'Article 1',
        'slug' => 'article-1',
        'description' => 'Lorem ipsum',
        'tags' => ['foo', 'bar'],
        'gallery' => [
            ['image' => 'image.jpg'],
            ['image' => 'image2.jpg'],
        ],
    ];

    public function testDestructureWithSingleKey()
    {
        [$tags, $article] = Arr::destructure(self::$post, 'tags');

        $this->assertEquals(['foo', 'bar'], $tags);
        $this->assertEquals(Arr::except(self::$post, 'tags'), $article);
    }

    public function testDestructureWithSingleKeyNotFound()
    {
        [$notFoundKey, $article] = Arr::destructure(self::$post, 'notFoundKey');

        $this->assertNull($notFoundKey);
        $this->assertEquals(self::$post, $article);
    }

    public function testDestructureWithArrayOfKeys()
    {
        [$tags, $gallery, $article] = Arr::destructure(self::$post, ['tags', 'gallery']);

        $this->assertEquals(['foo', 'bar'], $tags);
        $this->assertEquals([['image' => 'image.jpg'], ['image' => 'image2.jpg']], $gallery);
        $this->assertEquals(Arr::except(self::$post, ['tags', 'gallery']), $article);
    }

    public function testDestructureWithGroupedKeys()
    {
        [$slug, $meta, $article] = Arr::destructure(self::$post, ['slug', ['tags', 'gallery']]);

        $this->assertEquals('article-1', $slug);
        $this->assertEquals(Arr::only(self::$post, ['tags', 'gallery']), $meta);
        $this->assertEquals(Arr::except(self::$post, ['slug', 'tags', 'gallery']), $article);
    }

    public function testDestructureWithArrayOfKeysNotFound()
    {
        [$slug, $notFoundKey, $notFoundMeta, $article] = Arr::destructure(self::$post, ['slug', 'notFoundKey', ['notFoundGroup', 'notFoundGroup2']]);
        $this->assertEquals('article-1', $slug);
        $this->assertNull($notFoundKey);
        $this->assertEquals([], $notFoundMeta);
        $this->assertEquals(Arr::except(self::$post, 'slug'), $article);
    }
}
