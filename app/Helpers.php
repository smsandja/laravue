<?php

function getPrice($priceInDecimals)
{
    $price = floatval($priceInDecimals) / 100;
    
    return number_format($price, 2, ',',' ') . ' FCFA';
}
function getPaye($totalInDecimals)
{
    $total = floatval($totalInDecimals);
    
    return number_format($total, 2, ',',' ') . ' EURO';
}