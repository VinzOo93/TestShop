<?php

namespace App\Tests\Helper;

use App\Helper\VATCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VATCalculatorTest extends KernelTestCase
{
    private ?VATCalculator $VATCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->VATCalculator = static::getContainer()->get(VATCalculator::class);
    }


    /** @dataProvider getDataPriceValues */
    public function testGetPriceArray($price, $vat, $rawPrice)
    {
        $priceToBeTest = $this->VATCalculator->getPriceArray($price);
        $this->assertEquals(
            $priceToBeTest,
            ['netPrice' => $price, 'vat' => $vat, 'rawPrice' => $rawPrice,],
        );

    }

    private function getDataPriceValues(): array
    {
        return [
            [96.00, 16.00, 80.00],
            [3769.91, 628.32, 3141.59],
            [19.20, 3.20, 16.00],
            [12345.00, 2057.50, 10287.50]
        ];

    }
}
