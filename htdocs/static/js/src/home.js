$(document).ready(function () {

    var $signFormBlock = $('.sign-form');
    if ($signFormBlock.length) {
        var $signForm = $signFormBlock.find('form');
        var $content = $signFormBlock.find('.register-content');

        $signForm.find('input[type=text][data-check]').bind('keyup', function () {
            var $tab = $content.find('input[type="radio"]:checked');
            var $this = $(this);
            var errSpan = $this.parent().find('.error');

            if ($tab.data('check') === false) {
                errSpan.addClass('hidden');
                return;
            }
            if (!$this.val()) {
                return;
            }

            var type = $this.data('check');
            action = 'register/check/' + type;
            data = {check: $this.val()};
            Api.callDelayed(action, data, function (data, status) {
                errSpan.addClass('hidden');
            }, function (data, status) {
                if (status == 409) {
                    errSpan.html('This ' + type + ' is already taken.');
                    errSpan.removeClass('hidden');
                }
            }, 300);
        });

        $signForm.bind('submit', function () {
            var $form = $(this);
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