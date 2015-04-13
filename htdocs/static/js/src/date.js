var DateFormat = {
    format : function (date, format) {
        if (DateFormat.formats[format]) {
            format = DateFormat.formats[format];
        }
        return format.replace('%y', date.getFullYear())
            .replace('%m', date.getMonth() + 1)
            .replace('%d', date.getDate())
            .replace('%D', date.getDate() + DateFormat.suffix(date.getDate()))
            .replace('%M', DateFormat.months[date.getMonth()]);
    },
    suffix : function (d) {
        d = parseInt(d);
        if ([11, 12, 13].indexOf(d % 100)) {
            switch (d % 10) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
            }
        }
        return 'th';
    },
    formats: {"date": "%y/%m/%d", "human": "%D %M %y", 'human-us': "%M %D, %y"},
    months : ["January", "February", "March",
        "April", "May", "June", "July", "August", "September",
        "October", "November", "December"]
}