<?php

class common_ErrorsController extends BaseController {

    public function notfound()
    {
        App::abort(404);
    }
}
