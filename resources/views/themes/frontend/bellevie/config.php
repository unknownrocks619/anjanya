<?php
return [
    'components'    => [
        'block_builder' => [
            'view'  => 'components.block_builder.view'
        ],
        'slider'    => [
            'view'   => 'components.slider.view',
        ],
        'icon_column'   => [
            'view'  => 'components.icon_column.view',
            'add'   => 'components.icon_column.add',
            'edit'  => 'components.icon_column.edit'
        ],
        'promotional_video' => [
            'view'  => 'components.promotional_video.view',
            'add'  => 'components.promotional_video.add',
            'edit'  => 'components.promotional_video.edit',
            'namespace' => 'PromotionalVideo\\PromotionalVideo'
        ],
        'hotel_block'   => [
            'add' => 'components.hotel_block.add',
            'edit' => 'components.hotel_block.edit',
            'view' => 'components.hotel_block.view',
            'namespace' => 'HotelBlock\\HotelBlock'
        ],
        'bullet_column'    => [
            'add'   => 'components.bullet_column.add',
            'edit'   => 'components.bullet_column.edit',
            'view'   => 'components.bullet_column.view',
            'namespace'   => 'BulletColumn\\BulletColumn'
        ],
        'contact_form'  => [
            'view'  => 'components.contact_form.view'
        ],
        'iframe'    => ['view' => 'components.iframe.view'],
        'clients'   => [
            'view'  => 'components.clients.view',
            'add'   => 'components.clients.add',
            'edit'  => 'components.clients.edit',
            'namespace' => 'Clients\\Clients'
        ],
        'testimonials'  => [
            'view'  => 'components.testimonials.view',
            'add'   => 'components.testimonials.add',
            'edit'  => 'components.testimonials.edit',
            'namespace' => 'Testimonial\\Testimonial'
        ]
    ],
];
