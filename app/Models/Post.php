<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * Get the route key for the model.
   */
  // public function getRouteKeyName(): string
  // {
  //   return 'slug';
  // }

  protected $with = ['category', 'author'];

  // Scope Query
  public function scopeFilter($query, array $filters)
  {
    $query->when(
      $filters['search'] ?? false,
      fn ($query, $search) =>
      $query
        ->where('title', 'like', '%' . $search . '%')
        ->orWhere('body', 'like', '%' . $search . '%')
    );

    $query->when(
      $filters['category'] ?? false,
      fn ($query, $category) =>
      $query
        ->whereHas(
          'category',
          fn ($query) =>
          $query->where('slug', $category)
        )
    );
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
