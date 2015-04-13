var Diary = {
    container  : null,
    ajaxContent: null,
    date       : null,
    fetch      : function () {
        Api.call('post/get/' + DateFormat.format(Diary.date, 'date'), {}, function (data, status) {
            Diary.show(data);
        }, function () {
            Diary.show();

        });
    },
    show       : function (data) {
        id = null;
        content = null;
        if (data) {
            id = data.id;
            content = data.content;
        }
        Diary.ajaxContent.find('.post').html(Editable.field('div', 'post', content, id, false));
        $dateContent = Diary.ajaxContent.find('.date');
        $dateContent.html(DateFormat.format(Diary.date, 'human'));
        Diary.container.find('.loader-container').stop().fadeOut(function () {
            Diary.ajaxContent.stop().fadeIn();
        });
    },
    hide       : function () {
        Diary.ajaxContent.stop().fadeOut(function () {
            Diary.container.find('.loader-container').stop().fadeIn();
        });
    },
    bind       : function () {

    }
};

$(document).ready(function () {
    Diary.container = $('.article');
    Diary.ajaxContent = Diary.container.find('.ajax-content');
    Diary.date = new Date();
});