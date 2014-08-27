<?php

Route::get('/404', array(
    'uses' => 'ErrorsController@notfound',
));
