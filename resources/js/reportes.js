var $table;
var selectionIds = [];	//Save selected ids
$(function () {
    $table = $("#example1").bootstrapTable({
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",		//Initialization coding
        url: '<%=basePath%>/order/queryOrderList',
        method: 'post',
        striped: true,			//Odd-even row gradient table
        pagination: true,		//Display paging
        clickToSelect: true,		//Checked
        maintainSelected: true,
        sidePagination: "server",    //Server Paging
        idField: "id",
        pageSize: 10,
        responseHandler: responseHandler, //This configuration is very important!!!!!!!!
        columns: [
            { field: 'checkStatus', checkbox: true }, 	//Give a field value of "checkStatus" to the multiple check box to change the selection status!!!!
            { field: 'id', visible: false },
            { field: 'orderNumber', title: "Order number", align: 'center', width: '10%' }
        ]
    });
    //Select the event operation array
    var union = function (array, ids) {
        $.each(ids, function (i, id) {
            if ($.inArray(id, array) == -1) {
                array[array.length] = id;
            }
        });
        return array;
    };
    //Unselect the event operation array
    var difference = function (array, ids) {
        $.each(ids, function (i, id) {
            var index = $.inArray(id, array);
            if (index != -1) {
                array.splice(index, 1);
            }
        });
        return array;
    };
    var _ = { "union": union, "difference": difference };
    //Bind selected events, cancel events, all selected, all cancelled
    $table.on('check.bs.table check-all.bs.table uncheck.bs.table uncheck-all.bs.table', function (e, rows) {
        var ids = $.map(!$.isArray(rows) ? [rows] : rows, function (row) {
            return row.id;
        });
        func = $.inArray(e.type, ['check', 'check-all']) > -1 ? 'union' : 'difference';
        selectionIds = _[func](selectionIds, ids);
    });
});
//Processing multi-checkbox data before tabling
function responseHandler(res) {
    $.each(res.rows, function (i, row) {
        row.checkStatus = $.inArray(row.id, selectionIds) != -1;	//Determine whether the current row's data id exists and the selected array, and if it exists, change the multi-check box state to true
    });
    return res;
}	