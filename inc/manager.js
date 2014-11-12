// "self-invoking" function
(function manger() {
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
        alert("jQuery ready");
    });
})();