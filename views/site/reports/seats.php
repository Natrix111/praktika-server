<h2>Отчет по количеству посадочных мест</h2>
<table border="1">
    <tr><th>Здание</th><th>Количество мест</th></tr>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= $building->name ?></td>
            <td><?= $building->rooms_sum_seats_count ?? 0 ?></td>
        </tr>
    <?php endforeach; ?>
</table>