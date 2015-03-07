var Crypto = {
    storage   : true,
    private   : null,
    token     : function () {
        cookie = Cookie.read('PHPSESSID');
        if (!cookie) {
            return Math.random();
        }
        return cookie;
    },
    store     : function () { // Try to store the key in the local storage
        if (!Crypto.storage) {
            Crypto.clear();
        } else {
            localStorage.setItem(Crypto.storageKey(), Crypto.getData())
        }
    },
    clear     : function () {
        localStorage.removeItem(Crypto.storageKey());
    },
    destroy   : function () {
        Crypto.clear();
        Crypto.key = null;
    },
    getData   : function () {
        return JSON.stringify({token: Crypto.token(), key: Crypto.key});
    },
    fetch     : function () {
        if (Crypto.storage) {
            str = localStorage.getItem(Crypto.storageKey());
            data = JSON.parse(str);
            if (data.token != Crypto.token()) {
                Crypto.clear();
            } else {
                Crypto.key = data.key;
            }
        }
    },
    storageKey: function () {
        return 'journal-key-storage';
    },
    prompt    : function () { // Ask for the new key again

    },
    build     : function (password) {
        Crypto.key = CryptoJS.PBKDF2(password, 'G2Rz]L0&-U<oC))M0t83r-cdi;nIOO-JFgSKg4goVm]s-:UX{3*!VIZgmzA7jDhc', {
            keySize: 512 / 32
        });
    },
    setStorage: function (v) {
        Crypto.storage = v;
        Crypto.store();
    }
};