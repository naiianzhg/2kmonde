<?php

use Faker\Generator as Faker;
use App\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    $images = ['about_bg.jpg', 'contact_bg.jpg', 'home_bg.jpg', 'post_bg.jpg'];
    $title = $faker->sentence(mt_rand(3, 10));
    return [
        'title' => $title,
        'subtitle' => str_limit($faker->sentence(mt_rand(10, 20)), 252),
        'page_image' => $images[mt_rand(0, 3)],
        'content_raw' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
        'meta_description' => "Meta for $title",
        'is_draft' => false,
    ];
});
