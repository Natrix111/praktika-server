<h2>Помещения по зданиям</h2>

<div class="search-container">
    <form method="get" action="/rooms/by-building" class="building-form">
        <div class="form-group">
            <label class="form-label">Выберите здание:</label>
            <select name="building_id" class="form-select" required>
                <option value="">-- Выберите здание --</option>
                <?php foreach ($buildings as $building): ?>
                    <option value="<?= $building->id ?>"
                        <?= isset($currentBuilding) && $currentBuilding->id == $building->id ? 'selected' : '' ?>>
                        <?= $building->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="form-button">Показать</button>
    </form>

    <?php if (isset($currentBuilding) && $currentBuilding): ?>
        <form method="get" action="/rooms/by-building" class="search-form">
            <input type="hidden" name="building_id" value="<?= $currentBuilding->id ?>">
            <div class="search-group">
                <input type="text" name="search" value="<?= htmlspecialchars($searchQuery) ?>"
                       class="search-input" placeholder="Поиск по названию">
                <button type="submit" class="search-button">
                    Искать
                </button>
                <?php if ($searchQuery): ?>
                    <a href="?building_id=<?= $currentBuilding->id ?>" class="clear-search">
                        сбросить
                    </a>
                <?php endif; ?>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php if (isset($currentBuilding) && $currentBuilding): ?>
    <div class="building-header">
        <h3>Здание: <?= $currentBuilding->name ?></h3>
        <?php if ($rooms->isNotEmpty()): ?>
            <p class="room-count">Найдено помещений: <?= $rooms->count() ?></p>
        <?php endif; ?>
    </div>

    <?php if ($rooms->isNotEmpty()): ?>
        <div class="rooms-list">
            <?php foreach ($rooms as $room): ?>
                <div class="room-item"><?= htmlspecialchars($room->name) ?></div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-rooms">
            <?= $searchQuery ? 'По вашему запросу ничего не найдено' : 'В этом здании нет помещений' ?>
        </p>
    <?php endif; ?>
<?php endif; ?>