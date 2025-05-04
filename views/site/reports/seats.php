<h2>Отчет по посадочным местам</h2>

<table class="report-table">
    <thead>
    <tr>
        <th>Здание</th>
        <th>Количество посадочных мест</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= $building->name ?></td>
            <td><?= $building->total_seats ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>