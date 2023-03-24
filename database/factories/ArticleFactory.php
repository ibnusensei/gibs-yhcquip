<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */

  protected $model = Article::class;

  public function definition(): array
  {
    return [
      'slug' => $this->faker->unique()->slug(),
      'title' => $this->faker->sentence(),
      'description' => $this->faker->paragraph(),
      'author' => $this->faker->name(),
      'comment' => $this->faker->paragraph(),
      'category_id' => $this->faker->numberBetween(1, 10),
    ];
  }
}
