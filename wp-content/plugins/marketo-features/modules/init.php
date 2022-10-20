<?php

add_filter('elementskit/modules/list', function($list){
    return array_merge($list, [
        'megamenu' => [
            'path' => XS_PLUGIN_DIR . 'modules/megamenu/',
            'slug' => 'megamenu',
            'title' => 'Megamenu'
        ]
    ]);
});