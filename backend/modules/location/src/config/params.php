<?php

use modava\location\LocationModule;

return [
<<<<<<< HEAD
    'availableLocales' => [
        'vi' => 'Tiếng Việt',
        'en' => 'English',
        'jp' => 'Japan',
    ],
=======
>>>>>>> master
    'locationName' => 'Location',
    'locationVersion' => '1.0',
    'status' => [
        '0' => LocationModule::t('location', 'Tạm ngưng'),
        '1' => LocationModule::t('location', 'Hiển thị'),
    ],
    'district-type' => [
        'Thành phố' => 'Thành phố',
        'Quận' => 'Quận',
        'Huyện' => 'Huyện',
        'Thị Xã' => 'Thị Xã'
    ],
    'ward-type' => [
        'Phường' => 'Phường',
        'Xã' => 'Xã',
        'Thị Trấn' => 'Thị Trấn'
    ]
];
