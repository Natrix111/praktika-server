<h2>Добавление помещения</h2>
<form method="post">
    <label>Название: <input type="text" name="name" required></label><br>
    <label>Тип:
        <select name="type_id" required>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type->id ?>"><?= $type->name ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Здание:
        <select name="building_id" required>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->id ?>"><?= $building->name ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Площадь: <input type="number" step="0.01" name="area" required></label><br>
    <label>Количество мест: <input type="number" name="seats_count"></label><br>
    <button>Добавить</button>
</form>