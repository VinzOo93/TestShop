<?php
declare(strict_types=1);

namespace App\Helper;

final class VATCalculator
{
    protected const TVA_RATE = 0.20;
    protected const DECIMAL = 2;

    public static function getPriceArray(float $price): array
    {
        $vat = self::calculateVat($price);
        return [
            'netPrice' => $price,
            'vat' => $vat,
            'rawPrice' => self::calculateRawPrice($price, $vat),
        ];
    }

    private static function calculateVat(float $price): float
    {
        return self::roundValue($price * self::TVA_RATE / (1 + self::TVA_RATE));
    }

    private static function calculateRawPrice(float $price, float $vat): float
    {
        return self::roundValue($price - $vat);
    }

    private static function roundValue(float $value): float
    {
      return round($value, self::DECIMAL);
    }

}
