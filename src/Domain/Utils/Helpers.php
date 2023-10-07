<?php

declare(strict_types=1);

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        foreach (func_get_args() as $x) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: *');
            header('Access-Control-Allow-Headers: *');

            if (!$x) {
                var_dump($x);
                continue;
            }
            print_r($x);
        }
        die;
    }
}
