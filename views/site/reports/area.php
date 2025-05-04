<h2>Общая площадь помещений по зданиям</h2>

<div class="report-summary">
    <p>Общая площадь всех зданий: <strong><?= number_format($grandTotal, 2) ?> м²</strong></p>
</div>

<table class="simple-report-table">
    <thead>
    <tr>
        <th>Здание</th>
        <th>Общая площадь помещений</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= $building->name ?></td>
            <td><?= number_format($building->total_area, 2) ?> м²</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <td><strong>Итого:</strong></td>
        <td><strong><?= number_format($grandTotal, 2) ?> м²</strong></td>
    </tr>
    </tfoot>
</table>