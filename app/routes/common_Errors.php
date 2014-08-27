<?php

Route::get('/404', array(
    'uses' => 'common_ErrorsController@notfound',
));
