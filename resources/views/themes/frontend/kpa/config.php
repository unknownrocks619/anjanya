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