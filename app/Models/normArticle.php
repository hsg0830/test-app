<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\normSubContent;

class normArticle extends Model
{
  use HasFactory;

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function subContents()
  {
    return $this->hasMany(normSubContent::class);
  }
}