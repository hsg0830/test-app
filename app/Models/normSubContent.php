<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\normArticle;

class normSubContent extends Model
{
  use HasFactory;

  public function normArticle()
  {
    return $this->belongsTo(normArticle::class);
  }
}