<?php

return [
    'image_driver' => 'gd',
    
    'image_variants' => [
        'thumbnail' => [
            'width' => 200,
            'height' => 200,
            'quality' => 90,
            'format' => 'webp',
        ],
        'small' => [
            'width' => 50,
            'height' => 50,
            'quality' => 70,
            'format' => 'webp',
        ],
    ],
];
