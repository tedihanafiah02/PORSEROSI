<?php
/**
 * SEO Tools Configuration for PORSEROSI
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        'defaults'       => [
            'title'        => 'PORSEROSI - Persatuan Olahraga Sepatu Roda Seluruh Indonesia',
            'titleBefore'  => false,
            'description'  => 'Website resmi PORSEROSI (Persatuan Olahraga Sepatu Roda Seluruh Indonesia). Organisasi induk olahraga sepatu roda, skateboard, dan scooter Indonesia.',
            'separator'    => ' | ',
            'keywords'     => [
                'PORSEROSI', 'PB PORSEROSI', 'Persatuan Olahraga Sepatu Roda Seluruh Indonesia', 'Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia',
                'sepatu roda Indonesia', 'skateboard Indonesia', 'scooter Indonesia',
                'atlet sepatu roda', 'atlet skateboard', 'atlet scooter',
                'juara sepatu roda', 'juara skateboard', 'juara scooter',
                'roller sports Indonesia', 'inline speed skating', 'inline skate', 'freestyle scooter'
            ],
            'canonical'    => 'current',
            'robots'       => 'index, follow',
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'PORSEROSI - Persatuan Olahraga Sepatu Roda Seluruh Indonesia',
            'description' => 'Website resmi PORSEROSI. Organisasi induk olahraga sepatu roda, skateboard, dan scooter Indonesia.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => 'PORSEROSI',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card'        => 'summary_large_image',
            'site'        => '@porserosi',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'PORSEROSI - Persatuan Olahraga Sepatu Roda Seluruh Indonesia',
            'description' => 'Website resmi PORSEROSI. Organisasi induk olahraga sepatu roda, skateboard, dan scooter Indonesia.',
            'url'         => null,
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];