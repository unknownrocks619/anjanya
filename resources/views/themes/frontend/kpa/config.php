<?php

return [
    'components' => [
        'background_image'   => [
            'view'  => 'components.background_image.view',
            'add'   => 'components.background_image.add',
            'edit'  => 'components.background_image.edit',
            'preview'   => 'components.background_image.preview',
            'namespace' => 'BackgroundImage'
        ],
        'contact_form'   =>  [
            'view'  => 'components.contact_form.view'
        ],
        'block_blog'    => [
            'add'   => 'components.block_blog.add',
            'edit'  => 'components.block_blog.edit',
            'view'  => 'components.block_blog.view',
            'preview'   => 'components.block_blog.preview',
            'namespace' => 'BlockBlog'
        ],
        'service_block'     => [
            'add'           => 'components.service_block.add',
            'edit'          => 'components.service_block.edit',
            'preview'       => 'components.service_block.preview',
            'view'          => 'components.service_block.view',
            'namespace'     => 'ServiceBlock'
        ]
    ],
    'header'    => [
        [
            'name'  => 'Default',
            'themename' => 'kpa',
            'namespace' => 'default',
            'screenshot'    => 'screenshot.png'
        ],
        [
            'name'  => 'Compact',
            'themename' => 'kpa',
            'namespace' => 'compact',
            'screenshot'    => 'screenshot.png'
        ],

    ]
];
