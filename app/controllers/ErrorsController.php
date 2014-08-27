<?php

class ErrorsController extends BaseController {

    public function notfound()
    {
        App::abort(404);
    }
}
