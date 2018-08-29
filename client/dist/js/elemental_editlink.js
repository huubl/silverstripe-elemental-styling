(function($){
    // use $ here safely

    // document ready
    $(function() {
        $('[data-cmseditlink!=""][data-cmseditlink]').each(function() {
            $(this).addClass('can-cms-edit');
            var cmseditlink = $(this).data('cmseditlink');
            cmseditlink = '<a href="' + cmseditlink + '" class="cms-edit-link" target="ceedit" style="display:none;"></a>';
            $(this).prepend(cmseditlink);
        });
    });
})(jQuery);
