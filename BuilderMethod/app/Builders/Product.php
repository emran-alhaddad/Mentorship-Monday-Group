<?php  
namespace App\Builders;

class Product
{
    private $details;
    private $variants;
    private $shippingMethods;

    public function __construct(ProductBuilder $builder)
    {
        $this->details = $builder->details;
        $this->variants = $builder->variants;
        $this->shippingMethods = $builder->shippingMethods;
    }

}