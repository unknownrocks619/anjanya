<?php
return [
    'components' => [
        'background_image' => [
            'edit' => 'components.background_image.edit',
            'add' => 'components.background_image.add',
            'view' => 'components.background_image.view',
            'namespace' => 'BackgroundImage'
        ],
        'card' => [
            'add' => 'components.card.add',
            'edit' => 'components.card.edit',
            'view'  => 'components.card.view',
            'namespace' => 'Card'
        ],
        'single_image_content' => [
            'add' => 'components.single_image_content.add',
            'edit' => 'components.single_image_content.edit',
            'view' => 'components.single_image_content.view',
            'namespace' => 'SingleImageContent'
        ],
        'events' => [
            'add' => 'components.event_list.add',
            'edit' => 'components.event_list.edit',
            'view' => 'components.event_list.view',
            'namespace' => 'EventComponent'
        ],
        'video' => [
            'add' => 'components.video.add',
            'edit' => 'components.video.edit',
            'view' => 'components.video.view',
            'namespace' => 'VideoComponent'

        ],
        'content'   => [
            'view'  => 'components.content.view',
            'edit'  => 'components.content.edit',
            'add'   => 'components.content.add',
            'namespace' => 'Content'
        ],
        'testimonials' => [
            'view' => 'components.testimonials.view',
            'edit' => 'components.testimonials.edit',
            'add' => 'components.testimonials.add',
            'namespace' => 'Testimonial'
        ],
        'banner' => [
            'view' => 'components.banner.view',
            'edit' => 'components.banner.edit',
            'add' => 'components.banner.add',
            'namespace' => "Banner"
        ],
        'contact_form' => [
            'view' => 'components.contact_us.view',
        ],
        'gallery' => [
            'view' => 'components.gallery.view'
        ]
    ],

    # Headers for theme
    'header'    => [
        [
            'screenshot'    => 'screenshot.png',
            'author'        => 'Binod Giri',
            'email'         => 'binod.giri003@gmail.com',
            'version'       => '1.0',
            'name'          => "Theme Default",
            'namespace'     => 'default',
            'themename'     => 'siddhamahayog'
        ],
    ],

    # Footers for theme.
    'footer'    => [
        [
            'screenshot'    => 'screenshot.png',
            'author'        => 'Binod Giri',
            'email'         => 'binod.giri003@gmail.com',
            'version'       => '1.0',
            'name'          => "Theme Default",
            'namespace'     => 'default',
            'themename'     => 'siddhamahayog'
        ],

    ],
];
