<?php

namespace Database\Factories;

use App\Models\MetaTagsByName;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MetaTagsByNameFactory extends Factory
{
    protected $model = MetaTagsByName::class;

    public function definition(): array
    {
        return [
            'keywords' => $this->faker->words(30),
            'robots' => 'index, follow',
            'google-site-verification' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'revisit-after' => $this->faker->word(),
            'generator' => $this->faker->word(),
            'googlebot' => $this->faker->word(),
            'mssmarttagspreventparsing' => $this->faker->word(),
            'no-cache' => $this->faker->word(),
            'google' => $this->faker->word(),
            'googlebot-news' => $this->faker->word(),
            'verify-v1' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'rating' => $this->faker->numberBetween(0, 20),
            'department' => $this->faker->word(),
            'audience' => $this->faker->word(),
            'doc_status' => $this->faker->word(),
            'twitter:title' => $this->faker->word(),
            'twitter:site' => $this->faker->url(),
            'twitter:url' => $this->faker->url(),
            'twitter:image' => $this->faker->imageUrl(),
            'twitter:image:alt' => $this->faker->word(),
            'twitter:description' => $this->faker->word(),
            'twitter:card' => 'summary_large_image',
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
