<?php
namespace App\Helpers;

class SweetAlert
{
    public static function mensaje(array $arr): array
    {
        return [
            'text'  => $arr[0] ?? 'XD',
            'timer' => $arr[1] ?? 1000,
            'icon'  => $arr[2] ?? 'success',
        ];
    }
}
