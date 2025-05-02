<h2>Отчет по площадям учебных аудиторий</h2>
<table border="1">
    <tr><th>Здание</th><th>Общая площадь аудиторий</th></tr>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= $building['name'] ?></td>
            <td><?= $building['rooms_sum'] ?? 0 ?> м²</td>
        </tr>
    <?php endforeach; ?>
    <tr><td><b>Итого</b></td><td><b><?= $total ?> м²</b></td></tr>
</table>