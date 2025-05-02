<!doctype html>
<html>
<head>
    <title>Деканат</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
<header class="header">
    <a href="/" class="logo">Деканат</a>
    <?php if (app()->auth->check()): ?>
        <div class="user-role">
            <?= app()->auth->user()->role->name === 'admin' ? 'Администратор' : 'Сотрудник деканата' ?>
        </div>
    <?php endif; ?>
</header>

<nav>
    <div class="menu">
        <?php if (app()->auth->check()): ?>
            <?php if (app()->auth->user()->role->name === 'admin'): ?>
                <a href="/employees/add">Добавить сотрудника</a>
            <?php endif; ?>
            <?php if (app()->auth->user()->role->name === 'employee'): ?>
                <a href="/buildings/add">Добавить здание</a>
                <a href="/rooms/add">Добавить помещение</a>
                <a href="/rooms/by-building">Помещения по зданиям</a>
                <a href="/reports/area">Отчет по площадям</a>
                <a href="/reports/seats">Отчет по местам</a>
            <?php endif; ?>
            <a href="/logout">Выход</a>
        <?php endif; ?>
    </div>
</nav>

<main><?= $content ?? '' ?></main>

</body>
</html>