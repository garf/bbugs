<div class="markupy-toolbar">
    <div class="btn-group">
        <a class="btn btn-sm btn-default mu-b" title="Bold" data-toggle="tooltip" data-placement="top"><i class="fa fa-bold"></i></a>
        <a class="btn btn-sm btn-default mu-i" title="Italic" data-toggle="tooltip" data-placement="top"><i class="fa fa-italic"></i></a>
        <a class="btn btn-sm btn-default mu-u" title="Underline" data-toggle="tooltip" data-placement="top"><i class="fa fa-underline"></i></a>
        <a class="btn btn-sm btn-default mu-s" title="Striked" data-toggle="tooltip" data-placement="top"><i class="fa fa-strikethrough"></i></a>
    </div>

    <div class="btn-group">
        <a class="btn btn-sm btn-default mu-h1" title="H1" data-toggle="tooltip" data-placement="top"><i class="fa fa-header"></i>1</a>
        <a class="btn btn-sm btn-default mu-h2" title="H2" data-toggle="tooltip" data-placement="top"><i class="fa fa-header"></i>2</a>
        <a class="btn btn-sm btn-default mu-h3" title="H3" data-toggle="tooltip" data-placement="top"><i class="fa fa-header"></i>3</a>
    </div>

    <div class="btn-group">
        <a class="btn btn-sm btn-default mu-code" title="Code" data-toggle="tooltip" data-placement="top"><i class="fa fa-code"></i></a>
        <a class="btn btn-sm btn-default mu-code-php" title="PHP Code" data-toggle="tooltip" data-placement="top">php</a>
    </div>
</div>
<script>
    $(document).ready(function(){
        var mku = new Markupy('<@ $to @>');
        mku.run();
    });
</script>