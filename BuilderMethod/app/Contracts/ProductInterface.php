<?php
namespace App\Contracts;

use App\DTOs\ProductDTO;

interface ProductInterface
{
    public function reset(): void;
    public function setName(string $name): self;
    public function setDescription(string $description): self;
    public function setVariants(array $variants): self;
    public function setShippingMethods(array $shippingMethods): self;
    public function build(): ProductDTO;
}