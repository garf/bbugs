<div class="bg">
    <div class="main">
        <header>
            @include('site.widgets.header')
            @include('site.widgets.menu')
        </header>
        <!-- content -->
        <section id="content">
            <div class="padding">
                <div class="wrapper p4">
                    <div class="col-3">
                        <div class="indent">
                            <div>
                                <h2>{{ $title }}</h2>
                                @if (count($news) == 0)
                                    <div class="alert alert-info">Нет новостей</div>
                                @else
                                    @foreach ($news as $new)
                                        <div class="news indent-bot2">
                                            <time class="tdate-2" datetime="{{ date('Y-m-d', $new->act_date) }}">{{ date('Y-m-d', $new->act_date) }}&nbsp;</time>
                                            <p class="p1"><a href="/news/{{ $new->url }}">{{ $new->title }}</a></p>
                                            {{ $new->short_content }}
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <div>
                                {{ $news->links() }}
                            </div>
                        </div>
                    </div>

                    @if (count($news) != 0)
                        <div class="col-4">
                            <div class="block-news">
                                <h3 class="color-4 p2">Тэги</h3>
                                <div class="wrapper indent-bot">
                                    <ul class="list-2">
                                        @foreach ($tags as $tag)
                                            <li><a href="/news/tag/{{ $tag->name }}">{{ $tag->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @include('site.widgets.three-blocks')
            </div>
        </section>
        <!-- footer -->
        @include('site.widgets.footer')
    </div>
</div>