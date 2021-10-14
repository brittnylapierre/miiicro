(function ($) {
    $.fn.mlTextArea = function (options) {
        var settings = $.extend({
            name: false,
            locales: [],
            currentLocale: false,
            translations: [],
        }, options);

        this.each(function (index, obj) {
            var name = settings.name;
            var currentLocale = settings.currentLocale;
            var locales = settings.locales;
            var translations = settings.translations;

            if (!name.length || !locales.length || !currentLocale.length) {
                console.log('Please fill the name and locales.');
                return;
            }

            $(obj).css('opacity', 0.2).css('display', 'none');
            $(obj).attr('value', translations[currentLocale]);
            $(obj).attr('lang', currentLocale);

            var outputHtml = '<div class="bs-component">';
                outputHtml += '<nav class="nav nav-pills nav-justified btn-group btn-group-toggle btn-hover-style-1">';
                for (var i = 0; i < locales.length; i++) {
                    outputHtml += '<a class="btn btn-outline-secondary btn-sm justify-content-center" data-toggle="tab" href="#">' + locales[i] + '</a>';
                }
                outputHtml += '</nav>';

                outputHtml += '<div id="js-multilanguage-tab-" class="tab-content py-3">';
                for (var i = 0; i < locales.length; i++) {
                    outputHtml += '<div class="tab-pane" id="mlfield"></div>';
                }
                outputHtml += '</div>';
            outputHtml += '</div>';

            $(obj).after(outputHtml);

        });
        return this;
    };
}(jQuery));
