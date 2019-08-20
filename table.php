<table id="jr-table">

<thead>

<tr>

<?php foreach ($this->order as $key): ?>

    <th>
        <?=$key?>
    </th>

<?php endforeach; ?>

</tr>

</thead>

<tbody>

<?php foreach ($this->items as $item): ?>

<tr>

<?php foreach ($this->order as $key): ?>

    <td>
        <?=$item->$key?>
    </td>

<?php endforeach; ?>

</tr>

<?php endforeach; ?>

</tbody>

</table>