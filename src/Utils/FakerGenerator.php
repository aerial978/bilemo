<?php

namespace App\Utils;

use Faker\Generator as BaseGenerator;

class FakerGenerator extends BaseGenerator
{
    public function mobileBrand()
    {
        $brands = ['Apple', 'Samsung', 'Huawei', 'Google', 'Sony', 'Xiaomi', 'Oppo', 'Honor', 'OnePlus', 'Realme'];

        return $brands[array_rand($brands)];
    }

    public function mobileModel($brand)
    {
        switch ($brand) {
            case 'Apple':
                $models = ['14 pro', 'SE', '13 pro max', '14 plus', '13 mini'];
                break;
            case 'Samsung':
                $models = ['Galaxy Z flip 5', 'Galaxy Z Fold 5', 'Galaxy S23+', 'Galaxy S22', 'Galaxy A54'];
                break;
            case 'Huawei':
                $models = ['Mate 40 Pro', 'Mate Xs', 'P50 Pro', 'Y6s', 'P40 Lite'];
                break;
            case 'Google':
                $models = ['Pixel 7a', 'Pixel 6a', 'Pixel 7 Pro', 'Pixel 5a', 'Pixel 6 Pro'];
                break;
            case 'Sony':
                $models = ['Xperia 5V', 'Xperia 10V', 'Xperia Pro-I', 'Xperia L4', 'Xperia 1 II'];
                break;
            case 'Xiaomi':
                $models = ['13 Ultra', '13 Lite', '12T Pro', '12 X', 'Redmi Note 11'];
                break;
            case 'Oppo':
                $models = ['Find N2 Flip', 'Find X5 Pro', 'Reno 8 Pro', 'Find X3 Lite', 'A57s'];
                break;
            case 'Honor':
                $models = ['Magic 5 Lite', 'Magic 4 Pro', 'Magic V', 'N90 Lite', 'X8'];
                break;
            case 'OnePlus':
                $models = ['Nord 3', 'Nord CE 3 Lite', '10T 5G', '11 5G', 'Nord 2T 5G'];
                break;
            case 'Realme':
                $models = ['11 Pro+', 'GT NEO 3T', 'C55', '9 Pro+', 'X3 superZoom'];
                break;
            default:
                $models = ['Model 1', 'Model 2', 'Model 3', 'Model 4', 'Model 5'];
        }

        return $models[array_rand($models)];
    }

    public function mobileCondition()
    {
        $conditions = ['Refurbished', 'New'];

        return $conditions[array_rand($conditions)];
    }

    public function mobileColor()
    {
        $colors = ['Red', 'Blue', 'Black', 'White', 'Silver', 'Gold'];

        return $colors[array_rand($colors)];
    }

    public function mobileScreenSize()
    {
        $screenSizes = ['5', '6', '7', '8', '9'];

        return $screenSizes[array_rand($screenSizes)];
    }
}
