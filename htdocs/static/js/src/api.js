var Api = {
    semaphores : {},
    call       : function (action, data, success, error) {
        data = MiddleWare.serialize(action, data);
        url = Config.Api.url + action;
        $.ajax({
            url    : url,
            data   : data,
            success: function (response, status) {
                if (response) {
                    data = MiddleWare.unserialize(action, JSON.parse(response));
                }
                if (success) {
                    success(data, status);
                }
            },
            error  : function (response, status, eThrown) {
                if (response.responseText && response.status != 404) { // Slim 404 returns rubbish
                    data = MiddleWare.unserialize(action, JSON.parse(response.responseText));
                } else {
                    data = {};
                }
                if (error) {
                    error(data, response.status);
                }
            }
        });

    },
    callDelayed: function (action, data, success, error, time, cancel) {
        if (cancel === undefined) {
            cancel = true;
        }
        if (cancel) {
            var semaphore = Math.random();
            Api.semaphores[action] = semaphore;
        }
        setTimeout(function () {
            if (semaphore != Api.semaphores[action]) {
                return;
            }
            Api.call(action, data, success, error);
        }, time);
    }
};
