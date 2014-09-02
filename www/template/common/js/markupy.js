/*
 * Plugin jQuery.BBCode
 * Version 0.2
 *
 * Based on jQuery.BBCode plugin (http://www.kamaikinproject.ru)
 */
(function($){
    $.fn.markupy = function(options){
        // default settings
        var options = $.extend({
            tag_bold: true,
            tag_italic: true,
            tag_underline: true,
            tag_striked: true,
            tag_h1: true,
            tag_h2: true,
            tag_h3: true,
            tag_code: true,
            tag_php: true
        },options||{});
        //  panel
        var text = '<div id="makupy_bar" class="btn-group">'
        if(options.tag_bold){
            text += '<a href="#" class="btn btn-default btn-sm" id="b" data-start="***" data-end="***" title="Bold">';
            text += '<i class="fa fa-bold"></i>';
            text += '</a>';
        }
        if(options.tag_italic){
            text += '<a href="#" class="btn btn-default btn-sm" id="i" data-start="|||" data-end="|||" title="Italic">';
            text += '<i class="fa fa-italic"></i>';
            text += '</a>';
        }
        if(options.tag_underline){
            text += '<a href="#" class="btn btn-default btn-sm" id="u" data-start="+++" data-end="+++" title="Underline">';
            text += '<i class="fa fa-underline"></i>';
            text += '</a>';
        }
        if(options.tag_striked){
            text += '<a href="#" class="btn btn-default btn-sm" id="s" data-start="---" data-end="---" title="Striked">';
            text += '<i class="fa fa-strikethrough"></i>';
            text += '</a>';
        }
        text += '</div> <div id="makupy_bar" class="btn-group">';
        if(options.tag_h1){
            text += '<a href="#" class="btn btn-default btn-sm" id="s" data-start="====" data-end="====" title="H1">';
            text += 'H1';
            text += '</a>';
        }
        if(options.tag_h2){
            text += '<a href="#" class="btn btn-default btn-sm" id="s" data-start="===" data-end="===" title="H2">';
            text += 'H2';
            text += '</a>';
        }
        if(options.tag_h3){
            text += '<a href="#" class="btn btn-default btn-sm" id="s" data-start="==" data-end="==" title="H3">';
            text += 'H3';
            text += '</a>';
        }
        text += '</div> <div id="makupy_bar" class="btn-group">';
        if(options.tag_code){
            text += '<a href="#" class="btn btn-default btn-sm" id="s" data-start="@ \r\n" data-end="\r\n @" title="Code">';
            text += '<i class="fa fa-code"></i>';
            text += '</a>';
        }
        if(options.tag_php){
            text += '<a href="#" class="btn btn-default btn-sm" id="s" data-start="@=php \r\n" data-end="\r\n @" title="PHP Code">';
            text += 'php';
            text += '</a>';
        }

        text += '</div>';

        $(this).wrap('<div id="makupy_container"></div>');
        $("#makupy_container").prepend(text);
        $("#makupy_bar a img").css("border", "none");
        var id = '#' + $(this).attr("id");
        var e = $(id).get(0);

        $('#makupy_bar a').click(function() {
            var start = $(this).attr("data-start");
            var end = $(this).attr("data-end");

            insert(start, end, e);
            return false;
        });
    }
    function insert(start, end, element) {
        if (document.selection) {
            element.focus();
            sel = document.selection.createRange();
            sel.text = start + sel.text + end;
        } else if (element.selectionStart || element.selectionStart == '0') {
            element.focus();
            var startPos = element.selectionStart;
            var endPos = element.selectionEnd;
            element.value = element.value.substring(0, startPos) + start + element.value.substring(startPos, endPos) + end + element.value.substring(endPos, element.value.length);
        } else {
            element.value += start + end;
        }
    }

// hotkeys
    $(document).keyup(function (e)
    { if(e.which == 17) isCtrl=false; }).keydown(function (e)
    { if(e.which == 17) isCtrl=true;
        if (e.which == 66 && isCtrl == true) // CTRL + B, bold
        {
            $("#b").click();
            return false;
        }
        else if (e.which == 73 && isCtrl == true) // CTRL + I, italic
        {
            $("#i").click();
            return false;
        }
        else if (e.which == 85 && isCtrl == true) // CTRL + U, underline
        {
            $("#u").click();
            return false;
        }
    })

})(jQuery)