<?php
return [
    'components'    => [
        'slider'    => [
            'add'   => 'components.slider.add',
            'edit'  => 'components.slider.edit',
            'namespace' => 'Slider\\Slider',
            'view'  => 'components.slider.view'
        ],
        'quotes'    => [
            'view'  => 'components.quotes.view'
        ],
        'icon_column' => [
            'preview'   => 'preview',
            'edit'      => 'components.icon_column.edit',
            'add'       => 'components.icon_column.add',
            'iframe'    => 'components.icon_column.iframe',
            'view'      => 'components.icon_column.view',
            'namespace'  => 'IconColumn\\IconColumn'
        ],
        'contact_form'  => [
            'view'  => 'components.contact_form.view'
        ]
    ],
];
