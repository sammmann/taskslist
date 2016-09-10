<div class="container-fluid">
    <section class="col .col-xs-12 .col-sm-6 .col-md-8 col-lg-12 main">
        <h3 class="text-primary">Панель управления заданиями </h3><hr>

        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <tr><th>Имя</th><th>Описание</th><th>Статус</th><th>Создано</th><th>Удалить</th></tr>
            </thead>
            
            <tbody id="task-list">
            <?php foreach ($tasks as $task) { ?>
            <tr class="<?= $task->id ?>">
                <td title="Нажмите, чтобы изменить">
                    <div class="editable" onclick="makeElementEditable(this)" 
                         onblur="upadateTaskName(this, <?= $task->id ?>)">
                        <?= $task->name ?>
                    </div>
                </td>
                <td title="Нажмите, чтобы изменить"> 
                    <div class="editable" onclick="makeElementEditable(this)" 
                         onblur="upadateTaskDescription(this, <?= $task->id ?>)">
                    <?= $task->description ?>
                    </div> 
                </td>
                <td> <div><?= $task->status ?></div> </td>
                <td><?= strftime("%b %d %Y", strtotime($task->created_at)) ?></td>
                <td style="width: 5%;"><button onclick="deleteTask(<?= $task->id ?>)"><i class="btn-danger fa fa-times"></i></button>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
</div>
