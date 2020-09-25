<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected  $fillable = [
        'tag', 'title', 'subtitle', 'page_image', 'meta_description', 'reverse_direction',
    ];

    /**
     * many-to-many relationship between post and tag
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag_pivot');
    }

    /**
     * Add any tag needed from the list
     */
    public static function addNeededTags(array $tags)
    {
        if (count($tags) === 0) {
            return;
        }

        $found = static::whereIn('tag', $tags)->get()->pluck('tag')->all();

        foreach (array_diff($tags, $found) as $tag) {
            static::created([
                'tag' => $tag,
                'title' => $tag,
                'subtitle' => 'Subtitle for ' . $tag,
                'page_image' => '',
                'meta_description' => '',
                'reverse_direction' => false,
            ]);
        }
    }

    /**
     * Return the index layout to use for a tag
     * @param $tag
     * @param string $default
     * @return string
     */
    public static function layout($tag, $default = 'blog.index')
    {
        $layout = static::where('tag', $tag)->get()->pluck('layout')->first();

        return $layout ? : $default;
    }
}
