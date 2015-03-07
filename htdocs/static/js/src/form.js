var Form = {
    data: function ($form) {
        var data = {}
        $form.serializeArray().map(function (item) {
            data[item.name] = item.value;
        });
        return data;
    }
}