<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class ProductController extends Controller
{

  use DisableAuthorization;
  protected $model = Product::class;
  
}
