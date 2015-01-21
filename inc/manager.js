// "self-invoking" function
(function manager() {
    // Load the script
    var script = document.createElement("script");
    script.src = 'https://code.jquery.com/jquery-1.11.1.min.js';
    script.type = 'text/javascript';
    document.getElementsByTagName("head")[0].appendChild(script);

    // Poll for jQuery to come into existance
    var checkReady = function(callback) {
        if (window.jQuery) {
            callback(jQuery);
        }
        else {
            window.setTimeout(function() { checkReady(callback); }, 100);
        }
    };

    function getLinks()
    {
        var url = document.URL;
        if (url.charAt(url.length-1) != "/")
            url = url.substring(0, url.lastIndexOf("/")+1);

        var tuples = new Array();
        $('body').find("a").each(function(){
            var h = $(this).attr("href");
            var t = $(this).text();
            h = parseLink(h, url);
            if (h != "" && (h.indexOf("pdf") > -1 || h.indexOf("txt") > -1 || h.indexOf("doc") > -1 || h.indexOf("docx") > -1))
                tuples.push([h, t]);
        });

        return tuples;
    }

    function parseLink(h, url)
    {
        if (h!="#" && typeof h !== "undefined" && h != "") {
            if (!h.match("^http")) {
                h = url + h;
            }
            return h;
        }
        return "";
    }

    // Start polling...
    checkReady(function($) {
        var links = getLinks();
        var id = $("#studybuddy-id").text();
        var login = $("#studybuddy-login").text();
        links.unshift([login, id]);

        //TODO Check if it already exists!
        var mgr = $('<iframe />', {
            id: 'manager',
            name: 'manager',
            src: 'http://studybuddy-atpwr.rhcloud.com/manager.php'
        });
        mgr.css({
            'display':'block',
            'position':'fixed',
            'right':'20px',
            'top': '20px',
            'width': '300px',
            'height': '500px',
            'background':'rgb(127, 177, 227)',
            'border':'5px solid rgb(0, 102, 170)',
            'border-radius':'8px'
        });

        mgr.appendTo('body');
        mgr.load(function(){
            var other = window.frames['manager'];
            other.postMessage(links, "*");
        });
        
    });
})();