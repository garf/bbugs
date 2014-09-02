<?php

Route::get('/download/{file_id}', array(
    'before' => 'auth',
    'as' => 'download',
    'uses' => 'FilesController@download',
))->where(array('file_id' => '[\-a-zA-Z0-9]+'));
