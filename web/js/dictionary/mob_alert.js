// Определение устройства
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};


function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return (setStr);
}

function set_cookie(name, value, expires, path, domain, secure) {
    var cookie_string = name + "=" + escape(value);

    if (expires) {
        var date = new Date(new Date().getTime() + expires * 1000);
        cookie_string += "; expires=" + date.toGMTString();
    }

    if (path)
        cookie_string += "; path=" + escape(path);

    if (domain)
        cookie_string += "; domain=" + escape(domain);

    if (secure)
        cookie_string += "; secure";

    document.cookie = cookie_string;
}



//   ios    -   itms-apps://itunes.apple.com/us/app/imdb-movies-tv/id1218253312
//   andoid -   market://details?id=ru.tatarmultfilm.suzlek
$(document).ready(function() {
    if (isMobile.iOS()) {
        if (!getCookie("alert-mobile")) {
            $body.append('<div id="mobile-app" class="fade in alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div class="app-text app-ios"><a href="itms-apps://itunes.apple.com/us/app/imdb-movies-tv/id1218253312">Приложение доступно для скачивания на вашем устройсте</a></div></div>');
            var url = location.hostname + (location.port ? ':' + location.port : '');
            set_cookie("alert-mobile", "show", "86400", "/", url, "");
        }
    }
    if (isMobile.Android()) {
        if (!getCookie("alert-mobile")) {
            $body.append('<div id="mobile-app" class="fade in alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div class="app-text app-android"><a href="market://details?id=ru.tatarmultfilm.suzlek">Приложение доступно для скачивания на вашем устройсте</a></div></div>');
            var url = location.hostname + (location.port ? ':' + location.port : '');
            set_cookie("alert-mobile", "show", "86400", "/", url, "");
        }
    }
});
