<tr data-row-id="<?=$id?>" data-parent-id="<?=$parent_id?>" class="node expanded">

    <?php for ($i=0; $i<$level; $i++): ?>
        <td></td>
    <?php endfor; ?>

    <td>
        <?=$group?>
        <?php if (count($node["children"])): ?>
            <a class="toggle-button" href="javascript:void(0);">+</a>
        <?php endif; ?>
    </td>

    <?php
        $column_offset = count(KEY_MAP) - $level - 1;
        for ($j=0; $j<$column_offset; $j++) {
            echo "<td></td>";
        }

        $amount = round($node["values"]["amount"], 1);
        $total = round($node["values"]["total"], 1);
        echo "<td>$amount</td>";
        echo "<td>$total</td>";
    ?>
    
</tr>