<?php
    View::creator('cabinet.widgets.left-menu', function ($view) {
        $params = array(
            'assigned' => Auth::user()->id,
            'statuses' => Issues::getInstance()->statsMapper('not_done'),
        );
        $issues = count(Issues::getInstance()->getByAssignee($params));
        $issues = ($issues == 0) ? '' : (string)$issues;
        $menuItems = array(
            array(
                'lang_key' => 'menu.dashboard',
                'url' => URL::route('index'),
                'counter' => '',
                'icon' => 'fa-dashboard',
                'menu_item' => 'index',
            ),
            array(
                'lang_key' => 'menu.projects',
                'url' => URL::route('projects'),
                'counter' => '',
                'icon' => 'fa-briefcase',
                'menu_item' => 'projects',
            ),
            array(
                'lang_key' => 'menu.issues',
                'url' => URL::route('issues'),
                'counter' => $issues,
                'icon' => 'fa-tasks',
                'menu_item' => 'issues',
            ),
            array(
                'lang_key' => 'menu.contacts',
                'url' => URL::route('contacts'),
                'counter' => '',
                'icon' => 'fa-book',
                'menu_item' => 'contacts',
            ),
            array(
                'lang_key' => 'menu.search',
                'url' => URL::route('search-index'),
                'counter' => '',
                'icon' => 'fa-search',
                'menu_item' => 'search',
            ),
        );
        $view->with('items', $menuItems);
    });
