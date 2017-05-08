<?php

return [

    'pdf' => [
        'enabled' => true,
        //'binary'  => base_path('vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'), // 32bit ubuntu
        //'binary'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'), // 64bit ubuntu
        'binary'  => base_path('vendor/profburial/wkhtmltopdf-binaries-osx/bin/wkhtmltopdf-amd64-osx'), // 64bit mac
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    'image' => [
        'enabled' => true,
        //'binary'  => base_path('vendor/h4cc/wkhtmltoimage-i386/bin/wkhtmltoimage-i386'), // 32bit ubuntu
        //'binary'  => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'), // 64bit ubuntu
        'binary'  => base_path('vendor/profburial/wkhtmltopdf-binaries-osx/bin/wkhtmltoimage-amd64-osx'), // 64bit mac
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],

];
