var MiddleWare = {
    list       : [],
    register   : function (ware) {
        MiddleWare.list.push(ware);
    },
    serialize  : function (action, data) {
        return MiddleWare.call(action, data, 'serialize');
    },
    unserialize: function (action, data) {
        return MiddleWare.call(action, data, 'unserialize');
    },
    call       : function (action, data, method) {

        for (i = 0; i < MiddleWare.list.length; i++) {
            if (MiddleWare.list[i][method]) {
                data = MiddleWare.list[i][method](action, data);
            }
        }
        return data;
    }
};