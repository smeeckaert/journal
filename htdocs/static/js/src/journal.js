$(document).ready(function () {
    var $journal = $('.journal');
    if ($journal.length) {
        Todo.fetch();
    }
});