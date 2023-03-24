<?php

namespace Database\Factories;

use App\Models\CategoryArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryArticle>
 */
class CategoryArticleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */

  protected $model = CategoryArticle::class;

  public function definition(): array
  {
    return [
      'slug' => $this->faker->slug(),
      'name' => $this->faker->sentence(),
    ];
  }
}
