var icon_open = '+';
var icon_close = '-';

function reset_table() {
    $(".jr-toggle").off();

    /*
    var table = $("#jr-table");
    table.empty();
    
    var thead = $("<thead></thead>").appendTo(table);
    var tbody = $("<tbody></tbody>").appendTo(table);
    var tr = $("<tr></tr>").appendTo(thead);

    node_order.forEach(function(node) {
        var th = $("<th></th>").html(node);
        tr.append(th);
    });

    value_keys.forEach(function(key) {
        var th = $("<th></th>").html(key);
        tr.append(th);
    });
    */
}

function reload_data() {
    $(".jr-row").each(function() {
        var self = $(this);
        var row_id = self.data("row-id");
        var children = $(`.jr-row[data-parent-id='${row_id}']`);
        self.find(".jr-toggle")
        .html(icon_close)
        .click(function() {
            if (self.hasClass("jr-expanded")) {
                children.trigger("jr-row:hide");
                self.removeClass("jr-expanded");
                $(this).html(icon_open);
            }
            else {
                children.trigger("jr-row:show");
                self.addClass("jr-expanded");
                $(this).html(icon_close);
            }
        });

        self.on("jr-row:hide",{},function() {
            self.addClass("jr-hide");
            children.trigger("jr-row:hide"); //hide all the children
        });

        self.on("jr-row:show",{},function() {
            self.removeClass("jr-hide");
            if (self.hasClass("jr-expanded")) { //only show children if expanded
                children.trigger("jr-row:show");
            }
        });
    });
}

function init_controls() {
    var columns = $("#columns");
    
    Object.keys(groups).forEach(function(group) {
        $("<option></option")
        .attr("value", group)
        .html(group)
        .appendTo(columns);
    });

    $("#moveup").click(function() {
        var index = $("#columns").prop("selectedIndex");
        var columns = $("#columns").children().toArray();
        if (index === 0) {
            return;
        }

        var item = columns.splice(index, 1)[0];
        columns.splice(index - 1, 0, item);
        $("#columns").html(columns);

        node_order = columns.map(function(c) {
            return c.value;
        });

        reload_data();
    });

    $("#movedown").click(function() {
        var index = $("#columns").prop("selectedIndex");
        var columns = $("#columns").children().toArray();
        if (index >= columns.length - 1) {
            return;
        }
        
        var item = columns.splice(index, 1)[0];
        columns.splice(index + 1, 0, item);
        $("#columns").html(columns);

        node_order = columns.map(function(c) {
            return c.value;
        });

        reload_data();
    });
}

$(document).ready(function() {
    //init_controls();

    reload_data();
});