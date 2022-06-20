$(document).ready(function () {
            setTimeout(function () {
                $.ajax({
                    url: mw.settings.api_url+'pingstats',
                    type: "POST",
                    dataType: "json"
                });
            }, 3337);
        });