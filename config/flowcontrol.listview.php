<?php

return [
    'date_format'       => 'd/m/Y',
    'time_format'       => 'H:i:s',
    'datetime_format'   => 'd/m/Y H:i:s',

    'formatters'        => [
        'yesno' => \FlowControl\ListView\Formatters\YesNoFormatter::class,
        'image' => \FlowControl\ListView\Formatters\ImageFormatter::class,
    ],

    'empty' => 'There are no records available.'
];