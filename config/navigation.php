<?php
return [
    'admin' => [
        'General' => [
            [
                'name' => 'Dashboard',
                'children' => [],
                'route' => 'admin.dashboard.dashboard',
                'icon' => 'icofont icofont-dashboard-web'
            ]
        ],

        'Plugins'   => [
          [
              'name'    => 'Hotel Management',
              'children'    => [
                  [
                      'name'    => 'Amenities',
                      'route' => 'admin.amenities.list',
                      'icon'    => ''
                  ],
                  [
                      'name'    => 'Room',
                      'route'   => 'admin.room.list',
                      'icon'    => ''
                  ],
                  [
                      'name'    => 'Testimonials',
                      'route'   => 'admin.testimonials.list',
                      'icon'    => ''
                  ],
                  [
                      'name'    => 'Clients',
                      'route'   => 'admin.clients.list',
                      'icon'    => ''
                  ],
                  [
                      'name'    => 'Event',
                      'route'   => 'admin.events.list',
                      'icon'    => ''
                  ],
                  [
                      'name'    => 'Donation',
                      'route'   => 'admin.donation.list',
                      'icon'    => ''
                  ],
              ],
              'route'   => '',
              'icon'    => ''
          ]  ,
        ],
        'CRM' => [
            [
                'name' => "Content Management",
                'children' => [
                    [
                        'name' => 'Pages',
                        'route' => 'admin.pages.list',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                    [
                        'name' => 'Post',
                        'route' => 'admin.posts.list',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                    [
                        'name' => 'Menus',
                        'route' => 'admin.menu.list',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                    [
                        'name' => 'Categories',
                        'route' => 'admin.categories.list',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                    [
                        'name' => 'Galleries',
                        'route' => 'admin.gallery-album.index',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                ],
                'icon' => '',
                'route' => ''
            ]

        ],
        'User Management' => [
            [
                'name'  => 'Users',
                'children'  => [
                    [
                        'name' => 'Staff / Admin',
                        'route' => 'admin.users.list',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                    [
                        'name'  => 'User',
                        'route' => 'admin.users.customers.index',

                    ],
                    [
                        'name' => 'Applications',
                        'route' => 'admin.users.applications.list',
                        'icon' => 'icofont icofont-settings-alt'
                    ],
                ],
                'icon' => '',
                'route' => ''
            ]
        ],
        'Web Builder'   => [
            [
                'name' => 'Components',
                'children'  => [],
                'icon'  => '',
                'route' => 'admin.components.common.list'
            ],
            [
                'name' => 'Slider',
                'children'  => [],
                'icon'  => '',
                'route' => 'admin.slider.album.list'
            ],
        ],
        'System'    => [
            [
                'name' => 'Look & Feel',
                'children'  => [
                    [
                        'name'  => 'Theme',
                        'children'  => [],
                        'route' => '',
                        'icon'  => ''
                    ],
                    [
                        'name'  => 'Header',
                        'children'  => [],
                        'route' => 'admin.themes.header.list',
                        'icon'  => 'icofont icofont-archive'
                    ],
                    [
                        'name'  => 'Footer',
                        'children'  => [],
                        'route' => 'admin.themes.footer.list',
                        'icon'  => 'icofont icofont-briefcase'
                    ]
                ],
                'route' => '',
                'icon'  => 'icofont icofont-ui-theme'
            ],
            [
                'name'  => 'System Health',
                'children'  => [],
                'route' => 'admin.settings.list',
                'icon'  => 'icofont icofont-settings-alt'
            ],
            [
                'name'  => 'Footer Settings',
                'children'  => [],
                'route' => 'admin.settings.footer-page',
                'icon'  => 'icofont icofont-settings-alt'
            ],
            [
                'name'  => 'Page Settings',
                'children'  => [],
                'route' => 'admin.settings.page-setting',
                'icon'  => 'icofont icofont-settings-alt'
            ],

        ]
    ]
];

// 'Video LMS' => [
//     [
//         'name' => 'Courses',
//         'children' => [
//             [
//                 'name' => 'Course List',
//                 'children' => [],
//                 'route' => 'admin.courses.list',
//                 'icon' => ''
//             ],
//             [
//                 'name' => 'Chapters List',
//                 'children' => [],
//                 'route' => 'admin.chapters.list',
//                 'icon' => ''
//             ],
//             [
//                 'name' => 'Lessons List',
//                 'children' => [],
//                 'route' => 'admin.lessions.list',
//                 'icon' => ''
//             ],
//         ],
//         'route' => '',
//         'icon' => 'icofont icofont-ui-user-group'
//     ],
//     [
//         'name' => 'Enrollment',
//         'children' => [
//             ['name' => "Users", 'children' => [], 'route' => ''],
//         ],
//         'route' => '',
//         'icon' => 'icofont icofont-ui-image'
//     ]
// ],
// 'Events' => [
//     [
//         'name' => 'Programs',
//         'children' => [
//             ['name' => 'List', 'children' => [], 'route' => ''],
//             ['name' => 'Create Program', 'children' => [], 'route' => '']
//         ],
//         'route' => '',
//         'icon' => 'icofont icofont-database-add'
//     ],
//     [
//         'name' => 'Donations',
//         'children' => [
//             ['name' => 'Sales', 'children' => [], 'route' => ''],
//             ['name' => 'Purchase', 'children' => [], 'route' => '']
//         ],
//         'route' => '',
//         'icon' => 'icofont icofont-database-add'
//     ],
// ],
// 'E-Commerce' => [
//     [
//         'name' => 'Oders / Products',
//         'children' => [
//             ['name' => 'Book List', 'children' => [], 'route' => 'admin.book.list'],
//             ['name' => 'Book Bundle', 'children' => [], 'route' => 'admin.book.bundle.list'],
//             ['name' => 'Product List', 'children' => [], 'route' => 'admin.ecom.list'],
//             ['name' => 'Orders', 'children' => [], 'route' => 'admin.orders.list'],
//             ['name' => 'Transactions', 'children' => [], 'route' => 'admin.transactions.list'],

//         ],
//         'route' => '',
//         'icon' => 'icofont icofont-database-add'
//     ],
// ],
// 'Organisation' => [
//     [
//         'name' => 'Settings',
//         'children' => [
//             ['name' => 'All Organisation', 'children' => [], 'route' => 'admin.org.list'],
//             ['name' => 'List Project', 'children' => [], 'route' => 'admin.org.projects.list'],
//             ['name' => 'Project Transactions', 'children' => [], 'route' => 'admin.org.transactions.list'],
//         ],
//         'route' => '',
//         'icon' => 'icofont icofont-settings-alt'
//     ],
// ],
