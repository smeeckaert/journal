var Todo = {
    container  : null,
    ajaxContent: null,
    fetch      : function () {
        Api.call('todo/list', {}, function (data, status) {
            for (i = 0; i < data.length; i++) {
                Todo.addItem(data[i]);
            }
            Todo.container.find('.loader-container').fadeOut(function () {
                Todo.ajaxContent.fadeIn();
            });
        }, function () {

        });
        Todo.bind();
    },
    bind       : function () {
        Todo.ajaxContent.find('button').bind('click', function () {
            Todo.addItem({content: null, id: null});
            Todo.ajaxContent.find('[data-new]').click();
        });
    },
    addItem    : function (data) {
        Todo.ajaxContent.append(Editable.field('p', 'todo', data.content, data.id));
    }
};

$(document).ready(function () {
    Todo.container = $('.todolist');
    Todo.ajaxContent = Todo.container.find('.ajax-content');
});