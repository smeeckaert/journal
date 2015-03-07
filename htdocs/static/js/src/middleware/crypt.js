var MiddleWareCrypt = {
    serialize: function (action, data) {

        // Always hash password before sending it to the server
        if (data['pwd']) {
            data['pwd'] = CryptoJS.SHA512(data['pwd']).toString();
        }
        return data;
    }
};

MiddleWare.register(MiddleWareCrypt);