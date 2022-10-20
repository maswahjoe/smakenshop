(function($) {
"use strict";

	$(document).ready(function() {

        var Random = Mock.Random;
        var json1 = Mock.mock({
            "data|10-50": [{
                name: function () {
                    return Random.name(true)
                },
                "id|+1": 1,
                "disabled|1-2": true,
                groupName: 'Group Name',
                "groupId|1-4": 1,
                "selected": false
            }]
        });

        $('.dropdown-mul-1').dropdown({

            data: json1.data,
            limitCount: 40,
            multipleMode: 'label',
            choice: function () {
                alert("Searchable Loaded");
            }
        });

	});

})(jQuery);