<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class AjaxPaginationController extends Controller
{
    public function index() {
      return Item::paginate(25);
    }
}