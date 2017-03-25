<script src="/plugins/tinymce/tinymce.min.js"></script>
<script>

    tinymce.init({
        selector: '.editor',
        height: 400,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',

        image_advtab: true,
        templates: [
                @foreach(App\Templates::editorTemplates() as $template)
                   {
                title: '{{$template->name}}', description: '{{$template->desc}}', content: '{!! str_replace("'","\'",$template->body) !!}'
            },
            @endforeach
    ],
        @if(env('APP_ENV')=='production')
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
        @endif
    });

    var miniOpts = {
        selector: ".mini-editor",
        menu: {
            file: {title: 'File', items: 'newdocument'},
            edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            insert: {title: 'Insert', items: 'link media | template hr'},
            view: {title: 'View', items: 'visualaid'},
            format: {
                title: 'Format',
                items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'
            },
            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
            tools: {title: 'Tools', items: 'spellchecker code'},
            newmenu: {title: 'New Menu', items: 'newmenuitem'}
        },
        menubar: 'file edit newmenu',
        setup: function (editor) {
            editor.addMenuItem('newmenuitem', {
                text: 'New Menu Item',
                context: 'newmenu',
                onclick: function () {
                    alert('yey!');
                }
            });
        }
    };
</script>