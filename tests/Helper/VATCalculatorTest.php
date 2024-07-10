<?php

namespace App\Tests\Helper;

use App\Helper\VATCalculator;
use PHPUnit\Framework\TestCase;

class VATCalculatorTest extends TestCase
{

    /** @dataProvider getDataPriceValues */
    public function testGetPriceArray($price, $vat, $rawPrice)
    {
        $this->assertEquals(
            VATCalculator::getPriceArray($price),
            ['netPrice' => $price, 'vat' => $vat, 'rawPrice' => $rawPrice,],
            '',
            0.01
        );

    }

    private function getDataPriceValues(): array
    {
        return [
            [96, 16, 80],
            [3769.91, 628.32, 3141.59],
            [19.20, 3.2, 16],
            [12345, 2057.50, 10287.5]
        ];

    }
}
