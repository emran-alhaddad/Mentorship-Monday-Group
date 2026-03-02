<?php
namespace App\DTOs;

class ProductDTO
{
    public string $name;
    public string $description;
    public array $variants;
    public array $shippingMethods;

}