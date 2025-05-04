<h2>Добавление помещения</h2>

<?php if (isset($message)): ?>
    <div class="error-message">
        <?php foreach ($message as $field => $errors): ?>
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <label>Название: <input type="text" name="name"></label><br>
    <label>Тип:
        <select name="type_id">
            <?php foreach ($types as $type): ?>
                <option value="<?= $type->id ?>"><?= $type->name ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Здание:
        <select name="building_id">
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->id ?>"><?= $building->name ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Площадь: <input type="number" step="0.01" name="area"></label><br>
    <label>Количество мест: <input type="number" name="seats_count"></label><br>
    <button>Добавить</button>
</form>