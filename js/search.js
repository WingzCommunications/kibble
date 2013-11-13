jQuery(document).ready(function($) {
    $("#search").click(function(e) {
        e.preventDefault();
        SearchBox.showMessage('Search our <strong style="color:#99ccff;">entire</strong> database.', {
            modal: true,
            modalcolor: "#336699",
            buttons: [{
                caption: "Search"
            }, {
                caption: "Cancel",
                cancel: true,
                important: true
            }],
            inputs: [{
                caption: "<b style='color:black;'>Search Query:</b>",
                value: "cute",
                error: "Enter keywords to be searched"
            }],
            callback: function(action, inputs) {
                var message = "";
                if (action != "CANCELLED") {
                    for (var i = 0; i < inputs.length; i++)
                    message = inputs[i].value;
                    window.location.href = '/search/' + message.replace(/[^a-z0-9]+/ig, "-");
                }
            }
        })
    });
}); 
