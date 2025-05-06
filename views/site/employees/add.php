<h2>Добавление сотрудника</h2>

<?php if (isset($message)): ?>
    <div class="error-message">
        <?php foreach ($message as $field => $errors): ?>
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <label>
        ФИО: <input type="text" name="name">
    </label><br>
    <label>
        Логин: <input type="text" name="login">
    </label><br>
    <label>
        Пароль: <input type="password" name="password">
    </label><br>
    <label>
        Аватар: <input type="file" name="avatar" accept="image/*">
    </label><br>
    <button type="submit">Добавить</button>
</form>