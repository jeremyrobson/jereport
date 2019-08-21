<table>
    <thead>
        <?php foreach ($this->order as $group): ?>
            <th><?=$group?></th>
        <?php endforeach; ?>
        <?php foreach ($this->sums as $sum): ?>
            <th><?=$sum?></th>
        <?php endforeach; ?>

    </thead>
    <tbody>

    <?php
        foreach ($this->root_node as $key => $node) {
            $this->draw_row($key, $node, 0);
        }
    ?>

    </tbody>
</table>