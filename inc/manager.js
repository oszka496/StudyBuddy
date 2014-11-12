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
        //TODO Check if it already exists!
        var mgr = $("<div id='study-buddy-manager'></div>");
        mgr.css({
            'display':'block',
            'position':'fixed',
            'right':'30px',
            'top': '30px',
            'width': '200px',
            'height': '500px',
            'background':'rgb(127, 177, 227)',
            'border':'8px solid rgb(0, 102, 170)',
            'border-radius':'8px'
        });
        $("body").append(mgr);
    });
})();