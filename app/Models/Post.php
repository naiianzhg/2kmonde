<?php

namespace App\Models;

use App\Services\Markdowner;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{
    protected $dates = ['published_at'];

    protected $fillable = [
        'title', 'subtitle', 'content_raw', 'page_image', 'meta_description', 'layout', 'is_draft', 'published_at',
    ];

    /**
     * Return date of published_at
     */
    public function getPublishDateAttribute($value)
    {
        return $this->published_at->format('Y-m-d');
    }

    /**
     * Return time of published_at
     */
    public function getPublishTimeAttribute($value)
    {
        return $this->published_at->format('g:i A');
    }

    /**
     * Content_raw alias
     */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }

    /**
     * many-to-many relationship between post and tag
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_pivot');
    }

    /**
     * Set the title attr and automatically the slug
     * @param $value
     */
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;

        if (! $this->exists) {
            $value = uniqid(str_random(8));
            $this->setUniqueSlug($value, 0);
        }
    }

    /**
     * Recursive routine to set a unique slug
     * @param $title
     * @param $extra
     */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title . '-' . $extra);

        if (static::where('slug', $slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Set the HTML content automatically when the raw content is set
     * @param $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    /**
     * Synchronize tag relation adding new tags as needed
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        Tag::addNeededTags($tags);

        if (count($tags)) {
            $this->tags()->sync(
                Tag::whereIn('tag', $tags)->get()->pluck('id')->all()
            );
            return;
        }

        $this->tags()->detach();
    }

    /**
     * Return URL to post
     * @param Tag|null $tag
     * @return \Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Foundation\Application|string
     */
    public function url(Tag $tag = null)
    {
        $url = url('blog/' . $this->slug);
        if ($tag) {
            $url .= '?tag=' . urlencode($tag->tag);
        }
        return $url;
    }

    /**
     * Return next post after this one or null
     * @param string $base
     * @return array
     */
    public function tagLinks($base = '/blog?tag=%TAG%')
    {
        $tags = $this->tags()->get()->pluck('tag')->all();
        $return = [];
        foreach ($tags as $tag) {
            $url = str_replace('%TAG%', urlencode($tag), $base);
            $return[] = '<a href="' . $url . '">' . e($tag) . '</a>';
        }
        return $return;
    }

    /**
     * Return newer post after this one or null
     * @param Tag|null $tag
     * @return mixed
     */
    public function newerPost(Tag $tag = null)
    {
        $query =
            static::where('published_at', '>', $this->published_at)
            ->where('published_at', '<=', Carbon::now())
            ->where('is_draft', 0)
            ->orderBy('published_at', 'asc');
        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }
        return $query->first();
    }

    /**
     * Return older post before this one or null
     * @param Tag|null $tag
     * @return mixed
     */
    public function olderPost(Tag $tag = null)
    {
        $query =
            static::where('published_at', '<', $this->published_at)
                ->where('is_draft', 0)
                ->orderBy('published_at', 'desc');
        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }
        return $query->first();
    }
}
