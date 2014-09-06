<?php

Route::get('/download/{file_id}', array(
    'before' => 'auth',
    'as' => 'download',
    'uses' => 'FilesController@download',
))->where(array('file_id' => '[\-a-zA-Z0-9]+'));

Route::get('/files/delete/{file_id}', array(
    'before' => 'auth',
    'as' => 'file-delete',
    'uses' => 'FilesController@deleteFile',
))->where(array('file_id' => '[\-a-zA-Z0-9]+'));
