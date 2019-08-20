var icon_open = '+';
var icon_close = '-';

function reset_table() {
    $(".toggle-button").off();

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
    $(".node").each(function() {
        var self = $(this);
        var row_id = self.data("row-id");
        var children = $(`.node[data-parent-id='${row_id}']`);
        self.find(".toggle-button")
        .html(icon_close);
        
        button.click(function() {
            if (self.hasClass("expanded")) {
                children.trigger("node:hide");
                self.removeClass("expanded");
                button.html(icon_open);
            }
            else {
                children.trigger("node:show");
                self.addClass("expanded");
                button.html(icon_close);
            }
        });
        self.on("node:hide",{},function() {
            self.addClass("hide");
            children.trigger("node:hide"); //hide all the children
        });
        self.on("node:show",{},function() {
            self.removeClass("hide");
            if (self.hasClass("expanded")) { //only show children if expanded
                children.trigger("node:show");
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