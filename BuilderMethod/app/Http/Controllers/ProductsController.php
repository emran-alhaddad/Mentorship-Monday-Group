<?php
namespace App\Http\Controllers;

use App\Builders\ProductDirector;
use App\Builders\ProductBuilder;
use App\DTOs\ProductDTO;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private ProductBuilder $builder;
    private ProductDirector $director;
    public function __construct()
    {
        $this->builder = new ProductBuilder();
        $this->director = new ProductDirector($this->builder);
    }

    public function buildSimpleDemoProduct()
    {
        return response()->json($this->director->buildSimpleDemoProduct());
    }

    public function buildAdvancedDemoProduct()
    {
        return response()->json($this->director->buildAdvancedDemoProduct());
    }
}