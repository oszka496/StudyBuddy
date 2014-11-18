// "self-invoking" function
(function manager() {
    // Load the script
    var script = document.createElement("script");
    script.src = 'http://localhost/StudyBuddy/inc/jquery-1.11.1.min.js';
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

    // Start polling...
    checkReady(function($) {
        var url = document.URL;
        var hrefs = new Array();
        if (url.charAt(url.length-1) != "/")
            url = url.substring(0, url.lastIndexOf("/")+1);
        var links = $('body').find("a").each(function(){
            var h = $(this).attr("href");
            if (h!="#" && typeof h !== "undefined" && h != "") {
                if (!h.match("^http")) {
                    console.log(url);
                    console.log(h);
                    h = url + h;
                }
                hrefs.push(h);
            }
        });
        //TODO Check if it already exists!
        var mgr = $('<iframe />', {
            id: 'manager',
            name: 'manager',
            src: 'http://localhost/StudyBuddy/manager.php'
        });
        mgr.css({
            'display':'block',
            'position':'fixed',
            'right':'30px',
            'top': '30px',
            'width': '250px',
            'height': '500px',
            'background':'rgb(127, 177, 227)',
            'border':'8px solid rgb(0, 102, 170)',
            'border-radius':'8px'
        });
        mgr.appendTo('body');
        mgr.load(function(){
            var other = window.frames['manager'];
            other.postMessage(hrefs, "*");
        });
        
    });
})();