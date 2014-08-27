<?php

Route::get('/d/{id}', array(
    'before' => 'auth|agent',
    'uses' => 'FilesController@d',
))->where(array('id' => '[_a-zA-Z0-9]+'));

