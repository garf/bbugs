<?php

class root_NewsController extends BaseController {


    public function index()
    {
        $data = array(
            'css' => array(),
            'js' => array(),
            'title' => 'Новости',
            'news' => NewsModel::getInstance()->getNews(array('paged' => true)),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.news.list', $data);
    }

    public function edit($id)
    {
        $data = array(
            'css' => array(
                '/template/common/css/plugins/bootstrap-datetimepicker.min.css',
            ),
            'js' => array(
                '/template/common/js/moment.js',
                '/template/common/js/plugins/bootstrap-datetimepicker.min.js',
                '/template/common/js/tinymce/tinymce.min.js',
                '/template/root/js/news/edit.js'
            ),
            'title' => 'Редактирование новости',
            'new' => NewsModel::getInstance()->getNewById($id),
            'tags' => NewsModel::getInstance()->getTagsByNewId($id),
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.news.edit', $data);
    }

    public function add()
    {
        $data = array(
            'css' => array(
                '/template/common/css/plugins/bootstrap-datetimepicker.min.css',
            ),
            'js' => array(
                '/template/common/js/moment.js',
                '/template/common/js/plugins/bootstrap-datetimepicker.min.js',
                '/template/common/js/tinymce/tinymce.min.js',
                '/template/root/js/news/edit.js'
            ),
            'title' => 'Добавление новости',
        );
        return View::make('root.main', $data)
            ->nest('body', 'root.news.add', $data);
    }

    public function save($id=null)
    {
        $tags = explode(',', Input::get('tags', ''));
        $tagsIds = NewsModel::getInstance()->saveTags($tags);
        $date = DateTime::createFromFormat('Y-m-d H:i:s', Input::get('date', date('Y-m-d H:i:s')));
        $params = array(
            'id' => $id,
            'title' => Input::get('title', ''),
            'short_content' => Input::get('short_content', ''),
            'content' => Input::get('content', ''),
            'url' => Input::get('url'),
            'act_date' => $date->getTimestamp(),
            'status' => Input::get('status', '0'),
        );

        if (empty($id)) {
            $exists = NewsModel::getInstance()->getNewByUrl($params['url']);
            if(!empty($exists)) {
                MiscModel::getInstance()->setSystemMessage('Данный URI занят','danger');
                return Redirect::to('/root/news-add')->withInput();
            }
        }

        $news_id = NewsModel::getInstance()->saveNew($params);
        NewsModel::getInstance()->addTagsToNews($news_id, $tagsIds);
        return Redirect::to('/root/news-edit/' . $news_id);
    }

    public function activation($id)
    {
        NewsModel::getInstance()->activationChange($id);
        return Redirect::to('/root/news');
    }

    public function delete($id)
    {
        NewsModel::getInstance()->deleteNew($id);
        return Redirect::to('/root/news');
    }
}
