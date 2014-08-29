<?php
    View::creator('cabinet.widgets.left-menu', function ($view) {
        $menuItems = array(
            array(
                'lang_key' => 'menu.dashboard',
                'url' => URL::route('index'),
                'icon' => 'fa-dashboard',
                'menu_item' => 'index',
            ),
            array(
                'lang_key' => 'menu.projects',
                'url' => URL::route('projects'),
                'icon' => 'fa-briefcase',
                'menu_item' => 'projects',
            ),
            array(
                'lang_key' => 'menu.issues',
                'url' => URL::route('issues'),
                'icon' => 'fa-tasks',
                'menu_item' => 'issues',
            ),
            array(
                'lang_key' => 'menu.contacts',
                'url' => URL::route('contacts'),
                'icon' => 'fa-book',
                'menu_item' => 'contacts',
            ),
        );
        $view->with('items', $menuItems);
    });
