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

        self::sort($this->root_node);
    }

    function insert_node(&$node, $item, $order_index) {
        $group = $this->order[$order_index];
        $text = $item->$group;

        //reverse lookup key map to find sort index
        $arr = KEY_MAP[$group];
        $sort_index = array_search($text, $arr);

        if (empty($node[$sort_index])) {
            $node[$sort_index] = array(
                "text" => $text,
                "children" => array(),
                "values" => array(
                    "amount" => 0,
                    "total" => 0
                )
            );
        }

        //if not yet reached end of order, recurse, else put the summed values
        if ($order_index < count($this->order) - 1) {
            $values = $this->insert_node($node[$sort_index]["children"], $item, $order_index + 1);
        }
        else {
            $values["amount"] = $item->amount;
            $values["total"] = $item->total;
        }

        $node[$sort_index]["values"]["amount"] += $values["amount"];
        $node[$sort_index]["values"]["total"] += $values["total"];

        return $values;
    }

    static function sort(&$array) {
        foreach ($array as &$value) {
            $children = &$value["children"];
            if (is_array($children) && sizeof($children)) {
               self::sort($children);
            }
        }
        return ksort($array);
     }

    static function zsort(&$node) {
        foreach ($node as $k => $subnode) {
            if (sizeof($subnode["children"])) {
                self::sort($subnode["children"]);
            }
        }

        uksort($node, function($a, $b) use (&$node) {
            return $node[$a] - $node[$b] ?: $a - $b;
        });
    }

    function draw_row($key, $node, $level, $parent_id = null) {
        $id = uniqid();
        $text = $node["text"];
        
        include("row.php");
        
        foreach ($node["children"] as $key => $node) {
            $this->draw_row($key, $node, $level + 1, $id);
        }
    }

    function render() {
        include("table.php");
    }

}


?>