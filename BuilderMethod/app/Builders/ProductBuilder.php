<?php  
namespace App\Builders;

use Illuminate\Support\Facades\Log;

class ProductBuilder
{
    public $details;
    public $variants;
    public $shippingMethods;

    public function __construct()
    {
        $this->details = [];
        $this->variants = [];
        $this->shippingMethods = [];
    }
    public function setDetails(array $details): self
    {
        Log::info('Builder Method: Setting details: ' . json_encode($details));
        $this->details = $details;
        return $this;
    }
    public function setVariants(array $variants): self
    {
        Log::info('Builder Method: Setting variants: ' . json_encode($variants));
        $this->variants = $variants;
        return $this;
    }
    public function setShippingMethods(array $shippingMethods): self
    {
        Log::info('Builder Method: Setting shipping methods: ' . json_encode($shippingMethods));
        $this->shippingMethods = $shippingMethods;
        return $this;
    }
    public function build(): Product
    {
        Log::info('Builder Method: Building product');
        return new Product($this);
    }
}