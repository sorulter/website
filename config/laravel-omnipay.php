<?php

return [

    // The default gateway to use
    'default' => 'alipay',

    // Add in each gateway here
    'gateways' => [
        'alipay' => [
            "driver" => 'Alipay_Secured',
            'options' => [
                'partner' => env('ALIPAY_PARTNER'),
                'key' => env('ALIPAY_APPID'),
                'sellerEmail' => env('ALIPAY_SELLER_EMAIL'),
                'returnUrl' => env('ALIPAY_RETURN_URL'),
                'notifyUrl' => env('ALIPAY_NOTIFY_URL'),
            ],
        ],
        'paypal' => [
            'driver' => 'PayPal_Express',
            'options' => [
                'solutionType' => '',
                'landingPage' => '',
                'headerImageUrl' => '',
            ],
        ],
    ],

];
