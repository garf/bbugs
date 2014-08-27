{{ $paginator }}
<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Агент</th>
        <th>Соединение</th>
        <th>Инстр.</th>
        <th>Плечи</th>
        <th>Балансы</th>
        <th>Объем</th>
        <th>Синхр.</th>
        <th>Открытие</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($statuses['items'] as $status)
    <tr class="{{{ ForexModel::getInstance()->getTypes($status['status'])['class'] }}}">
        <td>{{{ $status['id'] }}}</td>
        <td><a href="/root/agent-view/{{{ $status['agent_id'] }}}">{{{ $status['agent_id'] }}}</a></td>
        <td>
            {{{ $status['connected1'] }}} :
            {{{ $status['connected2'] }}}
        </td>
        <td>{{{ $status['instrument'] }}}</td>
        <td>
            {{{ $status['leverage1'] }}} :
            {{{ $status['leverage2'] }}}
        </td>
        <td>
            {{{ MiscModel::getInstance()->moneyFormatForex($status['balance1']) }}}
            : {{{ MiscModel::getInstance()->moneyFormatForex($status['balance2']) }}}
        </td>
        <td>
            @if ($status['volume'] > 0)
                {{{ MiscModel::getInstance()->moneyFormatForex($status['volume']) }}}
            @else
                {{{ MiscModel::getInstance()->moneyFormatForex(ForexModel::getInstance()->countLot($status['balance1'], $status['balance2'])) }}}
            @endif
        </td>
        <td>{{{ date('Y-m-d H:i:s', $status['check_time']) }}}</td>
        <td>{{{ date('Y-m-d H:i:s', $status['open_time']) }}}</td>
        <td>{{{ ForexModel::getInstance()->getTypes($status['status'])['text'] }}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
{{ $paginator }}