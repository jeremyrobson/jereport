<?php

require_once('item.php');

class Report {
    var $items;
    var $order;
    var $root_node;

    function __construct($order, $sums) {
        $this->order = $order;
        $this->sums = $sums;

        $this->items = array();
        for ($i=0;$i<100;$i++) {
            $this->items[] = new Item();
        }

        $this->root_node = array();

        foreach ($this->items as $item) {
            $this->insert_node($this->root_node, $item, 0);
        }
    }

    function render() {
        include_once("table.php");
    }

    function insert_node(&$node, $item, $index) {
        $group = $this->order[$index];
        $key = $item->$group;

        if (empty($node[$key])) {
            $node[$key] = array(
                "children" => array(),
                "values" => array(
                    "amount" => 0,
                    "total" => 0
                )
            );
        }

        //if not yet reached end of order, recurse, else put the summed values
        if ($index < count($this->order) - 1) {
            $values = $this->insert_node($node[$key]["children"], $item, $index + 1);
        }
        else {
            $values["amount"] = $item->amount;
            $values["total"] = $item->total;
        }

        $node[$key]["values"]["amount"] += $values["amount"];
        $node[$key]["values"]["total"] += $values["total"];

        return $values;
    }

    function draw_row($group, $node, $level, $parent_id = null) {
        $id = uniqid();

        include("row.php");
        
        foreach ($node["children"] as $group => $node) {
            $this->draw_row($group, $node, $level + 1, $id);
        }
    }

    function render2() {
        echo "<table><tbody>";
        foreach ($this->root_node as $group => $node) {
            $this->draw_row($group, $node, 0);
        }
        echo "</tbody></table>";
    }

}


?>