<?php
    return [
        'template' => [
            'sidebar_start' => TEMPLATES_PATH . 'sidebarstart.php',
            ':view'         => ':action_view',
            'sidebar_end'   => TEMPLATES_PATH . 'sidebarend.php',
        ],
        'header_resources' => [
            'css' => [
                'bootstrap'         => CSS . 'bootstrap.min.css',
                'fontawesome'       => CSS . 'fontawesome.css',
                'datatable'         => CSS . 'datatables.min.css',
                'document'          => CSS . 'doc.css'
            ],
            'js' => []
        ],
        'footer_resources' => [
            'js' => [
                'jquery'            => JS . 'jquery.min.js',
                'popper'            => JS . 'popper.min.js',
                'bootstrap'         => JS . 'bootstrap.min.js',
                'datatable'         => JS . 'datatables.min.js',
                'document'          => JS . 'doc.js'
            ]
        ]
    ];