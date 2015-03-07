$(document).ready(function () {

    var $signFormBlock = $('.sign-form');
    if ($signFormBlock.length) {
        var $signForm = $signFormBlock.find('form');

        $signForm.bind('submit', function () {
            var $form = $(this);
            var $content = $signFormBlock.find('.register-content');
            var $loader = $signFormBlock.find('.loader-container');
            var $tab = $content.find('input[type="radio"]:checked');
            action = $tab.data('action');
            data = Form.data($form);
            Api.call(action, data, function (data, status) {
                console.log('success');
                console.log(data);
                console.log(status);
            }, function (data, status) {
                console.log('error');
                console.log(data);
                console.log(status);
            });
            $loader.find('.message').html($tab.data('message'));
            $content.fadeOut(function () {
                $loader.fadeIn();
            });
            return false;
        });
    }

});