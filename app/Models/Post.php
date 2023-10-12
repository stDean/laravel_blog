<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
  use HasFactory;

  // protected $guarded = [];

  /**
   * Get the route key for the model.
   */
  // public function getRouteKeyName(): string
  // {
  //   return 'slug';
  // }

  protected $with = ['category', 'author'];

  // Scope Query
  // Helps to filter and not create un-necessary routes 
  public function scopeFilter($query, array $filters)
  {
    // Search
    $query->when(
      $filters['search'] ?? false,
      fn ($query, $search) =>
      $query
        ->where(
          fn ($query) =>
          $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%')
        )
    );

    // fetching the category with the slug
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

    // fetching the user with the username
    $query->when(
      $filters['author'] ?? false,
      fn ($query, $author) =>
      $query
        ->whereHas(
          'author',
          fn ($query) =>
          $query->where('username', $author)
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

  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class);
  }
}
