var Api = {
    call: function (action, data, success, error) {
        data = MiddleWare.serialize(action, data);
        url = Config.Api.url + action;
        $.ajax({
            url    : url,
            data   : data,
            success: function (response, status) {
                data = MiddleWare.unserialize(action, response);
                success(data, status);
            },
            error  : function (response, status, eThrown) {

                data = MiddleWare.unserialize(action, JSON.parse(response.responseText));
                error(data, response.status);
            }
        });

    }
};
