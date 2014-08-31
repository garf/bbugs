function Markupy(element) {
    this.element = element;
}


Markupy.prototype.wrapText = function(openTag, closeTag) {

    var textArea = $(this.element);
    var len = textArea.val().length;
    var start = textArea[0].selectionStart;
    var end = textArea[0].selectionEnd;
    var selectedText = textArea.val().substring(start, end);
    var replacement = openTag + selectedText + closeTag;
    textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
};

Markupy.prototype.run = function(){
    $('.markupy-toolbar a.mu-b').click(this.wrapText('*', '*'));
    $('.markupy-toolbar a.mu-i').click(this.wrapText('|', '|'));
    $('.markupy-toolbar a.mu-s').click(this.wrapText('!', '!'));
    $('.markupy-toolbar a.mu-u').click(this.wrapText('+', '+'));
    $('.markupy-toolbar a.mu-h1').click(this.wrapText('---', '---'));
    $('.markupy-toolbar a.mu-h2').click(this.wrapText('--', '--'));
    $('.markupy-toolbar a.mu-h3').click(this.wrapText('-', '-'));
    $('.markupy-toolbar a.mu-code').click(this.wrapText('[code=php]', '[/code]'));
};

