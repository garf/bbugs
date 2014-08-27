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
                            <h2>{{ $title }}</h2>
                            <div class="news indent-bot2">
                                <time class="tdate-2" datetime="{{ date('Y-m-d', $new->act_date) }}">{{ date('Y-m-d', $new->act_date) }}&nbsp;</time>
                                <br />
                                <br />
                                {{ $new->content }}
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="block-news">
                            <h3 class="color-4 p2">Тэги новости</h3>
                            <div class="wrapper indent-bot">
                                <ul class="list-2">
                                    @foreach ($tags as $tag)
                                    <li><a href="/news/tag/{{ $tag->name }}">{{ $tag->name }}</a></li>
                                    @endforeach
                                </ul>

                            </div>
                            <a href="/news" class="button-2">К новостям</a>
                        </div>
                    </div>
                </div>
                @include('site.widgets.three-blocks')
            </div>
        </section>
        <!-- footer -->
        @include('site.widgets.footer')
    </div>
</div>