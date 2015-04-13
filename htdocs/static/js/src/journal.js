$(document).ready(function () {
    var $journal = $('.journal');
    if ($journal.length) {
        Diary.fetch();
        Todo.fetch();
    }
})
;