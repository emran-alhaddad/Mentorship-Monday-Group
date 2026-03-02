<?php
namespace App\Builders;

use App\Contracts\ProductInterface;
use App\DTOs\ProductDTO;

class ProductDirector
{
    public function __construct(private ProductInterface $builder)
    {
    }

    public function buildSimpleDemoProduct(): ProductDTO
    {
        $product = $this->builder->setName('Simple Demo Product')
            ->setDescription('This is a demo product')
            ->build();
        $this->builder->reset();
        return $product;
    }

    public function buildAdvancedDemoProduct(): ProductDTO
    {
        $product = $this->builder->setName('Advanced Demo Product')
            ->setDescription('This is an advanced demo product')
            ->setVariants(['Variant 1', 'Variant 2', 'Variant 3'])
            ->setShippingMethods(['Shipping Method 1', 'Shipping Method 2', 'Shipping Method 3'])
            ->build();
        $this->builder->reset();
        return $product;
    }
}