<?php
namespace App\Builders;

use App\Contracts\ProductInterface;
use App\DTOs\ProductDTO;

class ProductBuilder implements ProductInterface
{
    private ProductDTO $product;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new ProductDTO();
    }

    public function setName(string $name): self
    {
        $this->product->name = $name;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->product->description = $description;
        return $this;
    }

    public function setVariants(array $variants): self
    {
        $this->product->variants = $variants;
        return $this;
    }

    public function setShippingMethods(array $shippingMethods): self
    {
        $this->product->shippingMethods = $shippingMethods;
        return $this;
    }

    public function build(): ProductDTO
    {
        $product =  $this->product;
        $this->reset();
        return $product;
    }
}   