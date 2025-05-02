<h2>Помещения по зданиям</h2>

<form method="get" action="/rooms/by-building" class="building-select-form">
    <label>
        Выберите здание:
        <select name="building_id" required>
            <option value="">-- Выберите здание --</option>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->id ?>"
                    <?= isset($currentBuilding) && $currentBuilding->id == $building->id ? 'selected' : '' ?>>
                    <?= $building->name ?> (<?= $building->address ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Показать</button>
</form>

<?php if (isset($currentBuilding) && $currentBuilding): ?>
    <div class="building-info">
        <h3>Здание: <?= $currentBuilding->name ?></h3>
        <p>Адрес: <?= $currentBuilding->address ?></p>
        <?php if ($currentBuilding->area): ?>
            <p>Общая площадь: <?= $currentBuilding->area ?> м²</p>
        <?php endif; ?>
    </div>

    <?php if (isset($rooms) && $rooms->isNotEmpty()): ?>
        <table class="rooms-table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Тип</th>
                <th>Площадь (м²)</th>
                <th>Количество мест</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= $room->name ?></td>
                    <td><?= $room->type->name ?? 'Не указан' ?></td>
                    <td><?= $room->area ?></td>
                    <td><?= $room->seats_count ?? '-' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"><strong>Итого:</strong></td>
                <td><strong><?= $rooms->sum('area') ?> м²</strong></td>
                <td><strong><?= $rooms->sum('seats_count') ?></strong></td>
            </tr>
            </tfoot>
        </table>
    <?php else: ?>
        <p class="no-rooms">В этом здании нет помещений</p>
    <?php endif; ?>

<?php endif; ?>