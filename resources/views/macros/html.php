<?php

Html::macro('isActive', function($route, $returnClass = true) {
    if( Route::current()->getName() == $route ) {
        if( $returnClass ) {
            return ' class="active"';
        } else {
            return ' active';
        }

    }
    return '';
});