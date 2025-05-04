<h2>Добавление здания</h2>

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
    <label>Название: <input type="text" name="name" ></label><br>
    <label>Адрес: <input type="text" name="address" ></label><br>
    <label>Площадь: <input type="number" step="0.01" name="area"></label><br>
    <button>Добавить</button>
</form>