<?php

define("STORAGE_FILE", "storage.json");

function saveTasks(array $tasks): void
{
    file_put_contents(STORAGE_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
}

function loadTasks()
{
    if (!file_exists(STORAGE_FILE)) {
        return [];
    }

    $data = file_get_contents(STORAGE_FILE);

    return $data ? json_decode($data, true) : [];
}

$tasks = loadTasks();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task']) && !empty(trim($_POST['task']))) {
        $tasks[] = [
            "task" => htmlspecialchars(trim($_POST['task'])),
            "done" => false
        ];

        saveTasks($tasks);
        header('Location:' . $_SERVER['PHP_SELF']);
        exit;


    } elseif (isset($_POST['delete'])) {

        unset($tasks[$_POST['delete']]);
        $tasks = array_values($tasks);
        saveTasks($tasks);
        header('Location:' . $_SERVER['PHP_SELF']);
        exit;

    } elseif (isset($_POST['toggle'])) {
        $tasks[$_POST['toggle']]['done'] = !$tasks[$_POST['toggle']]['done'];
        saveTasks($tasks);
        header('Location:' . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Md Majharul Islam -Todo List</title>
    <link rel="stylesheet" href="style.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container" id="draggableContainer">
        <div class="drag-handle" id="dragHandle">😎</div>
        <h1 class="glitch-title">DEV-TASK</h1>

        <form method="post" class="task-form">
            <input type="text" name="task" class="task-input" placeholder="Enter new mission..." autocomplete="off"
                required>
            <button type="submit" class="add-btn">SET</button>
        </form>
        <!-- task list -->

        <?php if (empty($tasks)): ?>
            <div class="empty-list">
                [ NO MISSION ASSIGNED IN THE SYSTEM ]
            </div>
        <?php else: ?>


            

            <ul class="task-list" id="sortableList">
                <?php foreach ($tasks as $index => $task): ?>

                    <!-- task item  & also count the task number  -->
                    <li class="task-item <?= $task['done'] ? 'completed' : '' ?>" data-index="<?= $index ?>">

                        <span class="task-text">
                            <?= $task['task'] ?>
                        </span>
                        <div class="task-actions">
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="toggle" value="<?= $index ?>">
                                <button type="submit" class="action-btn toggle-btn" title="Toggle status">
                                    <?= $task['done'] ? '↩' : '✓' ?>
                                </button>
                            </form>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="delete" value="<?= $index ?>">
                                <button type="submit" class="action-btn delete-btn" title="Delete task">×</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>

</html>