jQuery(document).ready(function ($) {
    "use strict";
    let arr = [
        "xs_header_builder_select",
        "xs_footer_builder_select"
    ]
    function header_builder(current , type) {
        let id = type === 'select2:select' ? current.val() : current.val(),
            admin_url = admin_url_object.admin_url + id;
          current.parents('.accordion-section').find(".xs_builder_edit_link").attr("href", admin_url);
    }
    arr.forEach(function (element) {
        if ($("#customize-control-" + element).length > 0) {
            $(document).on('click', '.accordion-section', function (e) {
                $('.select2-hidden-accessible').on("select2:select", function(e) {
                    header_builder($(this), e.type)
                });
            })
        }
    })
});
