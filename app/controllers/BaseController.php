<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

    protected $rawPost = array();

    public function __construct()
    {
        try {
            $this->parsePostParams();
            if(Input::has('x')) {
                $x = intval(Input::get('x', 0));
                if (!empty($x)) {
                    Session::set('x', $x);
                    Session::set('x_referal', URL::previous());
                    Session::set('x_url', Request::fullUrl());
                }
                if ($x == 0) {
                    Session::flush('x');
                }
            }
            if (!Session::has('x_referal')) {
                Session::set('x_referal', URL::previous());
            }
            if (!Session::has('x_url')) {
                Session::set('x_url', Request::fullUrl());
            }
        } catch (Exception $e) {

        }
    }

    protected function parsePostParams()
    {
        $post = Request::instance()->getContent();
        parse_str($post, $this->rawPost);
    }

    protected function post($key, $default=false)
    {
        return (isset($this->rawPost[$key])) ? $this->rawPost[$key] : $default;
    }

    protected function postAll()
    {
        return ($this->rawPost);
    }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
