
    $(document).ready(function() {
        // Вешаем обработчик события "клик" на все ссылки с классом ajax_link
        $('button.submit').click(function() {
            // Берем действие из атрибута data-action ссылки
            var parent = $(this).data('parent');
            var level = $(this).data('level');
            var str = '#div_hidden_input'+parent;
            // query append
            $('#comments-parent_id').val(parent);
            $('#comments-level').val(level);
            var div_input = $(str);
            div_input.append($( ".blog-form" ));
        })
    });
