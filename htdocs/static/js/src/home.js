$(document).ready(function () {

    var $signFormBlock = $('.sign-form');
    if ($signFormBlock.length) {

        function checkForm() {
            var $tab = $content.find('input[type="radio"]:checked');
            if ($tab.data('check') === false) {
                $content.find('.error').addClass('hidden');
            }
            match = '';
            if ($tab.val() == 'signin') {
                match = ':not(.show-register)';
            }
            rows = $content.find('.row' + match + ' input[type!=radio]');
            var empty = false;
            rows.each(function () {
                if (!$(this).val()) {
                    empty = true;
                }
            });
            $content.find('button').prop('disabled', empty);
        }

        var $signForm = $signFormBlock.find('form');
        var $content = $signFormBlock.find('.register-content');

        $signForm.find('input').bind('change', checkForm);
        $signForm.find('input[type!=radio]').bind('keyup', checkForm);
        $signForm.find('input[type=text][data-check]').bind('keyup', function () {
            var $tab = $content.find('input[type="radio"]:checked');
            var $this = $(this);
            if ($tab.data('check') === false) {
                return;
            }
            if (!$this.val()) {
                return;
            }
            var errSpan = $this.parent().find('.error');
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
            var data = Form.data($form);
            Api.call(action, data, function (response, status) {
                Crypto.build(data.pwd);
                Crypto.setStorage(true); // Store the key in local storage
                document.location = '/journal';
            }, function (data, status) {
                message = '';
                if (status == 404) {
                    message = 'Wrong password or login.';
                } else if (status == 409) {
                    message = 'An user with the same informations is already registered.';
                } else if (status == 406) {
                    message = 'Incorrect informations.';
                }
                $form.find('.error.message').html(message).removeClass('hidden');
                $loader.stop().fadeOut(function () {
                    $content.stop().fadeIn();
                });

            });
            $loader.find('.message').html($tab.data('message'));
            $content.fadeOut(function () {
                $loader.fadeIn();
            });
            return false;
        });
    }

});