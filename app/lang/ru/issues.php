<?php

return array(
    'issues' => 'Задачи',
    'issue_edit' => 'Редактирование задачи',
    'issues_to_me' => 'Задачи назначенные мне',

    'issue_title' => 'Название',
    'issue_description' => 'Описание',
    'issue_status' => 'Статус',
    'issue_type' => 'Тип',
    'issue_priority' => 'Приоритет',
    'issue_assigned' => 'Назначена',
    'hours_to_complete' => 'Часов на завершение',
    'project' => 'Проект',
    'updated' => 'Обновлена',
    'creator' => 'Создатель',
    'created' => 'Создано',
    'assignee' => 'Исполнитель',
    'issue_settings' => 'Параметры',
    'issue_content' => 'Содержание',

    'you' => 'Вы',
    'minimize' => 'Свернуть',

    'new_issue' => 'Новая задача',
    'create_issue' => 'Создать задачу',

    'detailed_description' => 'Подробное описание',
    'comments' => 'Коментарии',
    'files' => 'Файлы',
    'new_comment' => 'Новый коментарий',
    'add_comment' => 'Добавить коментарий',
    'update_issue' => 'Обновить задачу',
    'edit_issue' => 'Изменить задачу',

    'all_opened' => 'Все открытые',
    'all_closed' => 'Все закрытые',
    'filter' => 'Фильтр',

    'no_more_files' => 'Больше файлов нельзя',
    'max_file_size' => 'Максимальный размер файла',
    'parameters' => 'Параметры',
    'attach_files' => 'Прикрепить файлы',
    'one_more_file' => 'Еще один файл',
    'assign_to' => 'Назначить для',
    'change_status' => 'Изменить статус',
    'ph_comment' => 'Введите ваш коментарий...',
    'delete' => 'Удалить',
    'quote' => 'Цитировать',
    'edit' => 'Изменить',

    'assigned' => 'Назначено',
    'assigned_nobody' => 'Не назначена',
    'no_issues' => 'Нет задач',
    'no_issues_assigned' => 'Нет задач назначенных мне',


    'files_were_uploaded' => ':num :pl',
    'files_pl' => 'файл загружен|файла загружено|файлов загружено',

    'no_assignee' => 'Задача никому не присвоена. Хотите оставить это так?',
    'cant_delete_comment' => 'Невозможно удалить коментарий',
    'comment_deleted' => 'Коментарий удален',
    'want_delete_comment' => 'Вы действительно хотите удалить свой коментарий?',
    'want_delete_file' => 'Вы действительно хотите удалить файл :name?',
    'issue_saved' => 'Изменения задачи сохранены',

    'markup' => 'Разметка',
    'preview' => 'Предпросмотр',

    'priority' => array(
        '1' => array(
            'title' => 'Критический',
            'icon' => '',
            'class' => 'priority_critical',
        ),
        '2' => array(
            'title' => 'Срочный',
            'icon' => '',
            'class' => 'priority_urgent',
        ),
        '3' => array(
            'title' => 'Высокий',
            'icon' => '',
            'class' => 'priority_high',
        ),
        '4' => array(
            'title' => 'Нормальный',
            'icon' => '',
            'class' => 'priority_normal',
        ),
        '5' => array(
            'title' => 'Низкий',
            'icon' => '',
            'class' => 'priority_low',
        ),
    ),
    'opened_group' => 'Открыто',
    'closed_group' => 'Закрыто',
    'status' => array(
        'new' => array('title' => 'Новая'),
        'news' => array('title' => 'Новые'),
        'opened' => array('title' => 'Открытая'),
        'openeds' => array('title' => 'Открытые'),
        'in_work' => array('title' => 'В работе'),
        'in_works' => array('title' => 'В работе'),
        'need_feedback' => array('title' => 'Нужен ответ'),
        'need_feedbacks' => array('title' => 'Нужен ответ'),
        'closed' => array('title' => 'Закрытая'),
        'closeds' => array('title' => 'Закрытые'),
        'not_actual' => array('title' => 'Не актуальная'),
        'not_actuals' => array('title' => 'Не актуальные'),
        'realized' => array('title' => 'Сделано'),
        'realizeds' => array('title' => 'Сделаны'),
        'rework' => array('title' => 'На доработку'),
        'reworks' => array('title' => 'На доработку'),
    ),
    'type' => array(
        'task' => array(
            'title' => 'Задача',
            'icon' => '',
            'bs_icon_class' => 'fa fa-bullseye text-success',
        ),
        'bug' => array(
            'title' => 'Баг',
            'icon' => '',
            'bs_icon_class' => 'fa fa-bug text-danger',
        ),
        'research' => array(
            'title' => 'Исследование',
            'icon' => '',
            'bs_icon_class' => 'fa fa-search text-info',
        ),
    ),
);