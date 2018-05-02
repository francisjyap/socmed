/*jslint browser: true*/
/*jslint vars: true, plusplus: true, devel: true, nomen: true, indent: 4, maxerr: 50 */
/*global $, */

/*Function Declarations*/

function refreshTableWithSelectValues() {
    "use strict";
	$('#table').bootstrapTable('refresh', {
		silent: true,
		url: 'profileSort/' + $('#selectType').val() + '/' + $('#selectInfAff').val()
	});
}

$(document).ready(function () {
    "use strict";
	$('#table').bootstrapTable({
		url: 'getProfiles',
		uniqueId: 'id',
		search: true,
        columns: [{
            field: 'name',
            title: 'Name',
            sortable: true
        }, {
            field: 'company_name',
            title: 'Company Name',
            sortable: true
        }, {
            field: 'phone_number',
            title: 'Phone Number'
        }, {
            field: 'country',
            title: 'Country',
            sortable: true
        }, {
            field: 'affliate_code',
            title: 'Affliate Code',
            sortable: true
        }, {
            field: 'is_influencer',
            title: 'Influencer',
            searchable: false,
            cellStyle: function (value) {
                if (value === 'Yes') {
                    return {
                        css: {'color': 'green'}
                    };
                } else {
                    return {
                        css: {'color': 'red'}
                    };
                }
            }
        }, {
            field: 'is_affliate',
            title: 'Affliate',
            searchable: false,
            cellStyle: function (value) {
                if (value === 'Yes') {
                    return {
                        css: {'color': 'green'}
                    };
                } else {
                    return {
                        css: {'color': 'red'}
                    };
                }
            }
        }]
	});
});

$('#table').on('click-row.bs.table', function (e, row) {
    "use strict";
	window.location.href = "viewProfile/" + row.id;
});

$('#btnResetFilter').on('click', function () {
    "use strict";
	$('#selectType').prop('selectedIndex', 0);
	$('#selectInfAff').prop('selectedIndex', 0);
	refreshTableWithSelectValues();
});

$('#selectType').change(function () {
    "use strict";
	refreshTableWithSelectValues();
});

$('#selectInfAff').change(function () {
    "use strict";
	refreshTableWithSelectValues();
});
