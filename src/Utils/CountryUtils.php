<?php

namespace Wossnap\CommissionTask\Utils;

class CountryUtils
{
    public static function isEu(string $alpha2): bool
    {
        $euCountries = [
            'AT', 
            'BE', 
            'BG', 
            'CY', 
            'CZ', 
            'DE', 
            'DK', 
            'EE', 
            'ES', 
            'FI', 
            'FR', 
            'GR', 
            'HR', 
            'HU', 
            'IE', 
            'IT', 
            'LT', 
            'LU', 
            'LV', 
            'MT', 
            'NL', 
            'PO', 
            'PT', 
            'RO', 
            'SE', 
            'SI', 
            'SK'
        ];
        
        return in_array($alpha2, $euCountries);
    }
}