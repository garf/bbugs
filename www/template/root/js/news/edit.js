$(function () {
    $('.datetime').datetimepicker({
        language:'ru',
        useCurrent: true,
        sideBySide: false,
        useSeconds: true
    });
});

tinymce.init({
    selector: "#ckeditor_content",
    resize: false,
    schema: "html5",
    language: 'ru',
    height: 600,
    plugins: 'advlist anchor autolink charmap code contextmenu directionality example fullscreen hr image jbimages layer link media nonbreaking noneditable pagebreak paste preview save searchreplace spellchecker table template textcolor visualblocks visualchars wordcount',
    toolbar: "save | code | insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor formatselect fontselect fontsizeselect | blockquote removeformat | bullist numlist outdent indent | link image jbimages",
    contextmenu: "copy paste | link image jbimages",
    relative_urls: false
});
