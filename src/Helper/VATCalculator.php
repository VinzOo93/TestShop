<?php
declare(strict_types=1);

namespace App\Helper;

final class VATCalculator
{
    public const TVA_RATE = 0.20;
    public const DECIMAL = 2;

    public function getPriceArray(float $price): array
    {
        $vat = self::calculateVat($price);
        return [
            'netPrice' => $this->formatValue($price),
            'vat' => $this->formatValue($vat),
            'rawPrice' => $this->formatValue(self::calculateRawPrice($price, $vat)),
        ];
    }
    public static function formatValue($value): float
    {
        return (float) number_format($value, self::DECIMAL, '.','');
    }

    private function calculateVat(float $price): float
    {
        return self::roundValue($price * self::TVA_RATE / (1 + self::TVA_RATE));
    }

    private function calculateRawPrice(float $price, float $vat): float
    {
        return $this->roundValue($price - $vat);
    }

    private  function roundValue(float $value): float
    {
      return $this->formatValue(round($value, self::DECIMAL));
    }


}
