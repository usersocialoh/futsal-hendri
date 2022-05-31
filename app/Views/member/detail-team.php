<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>
    <h4 class="text-center"><?= $team[0]['team'] ?></h4>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Member name</th>
        </tr>
        </thead>
        <tbody>
        <?php $count = 1; ?>
        <?php foreach ($team as $t): ?>
        <tr>
                <td style="width: 50px;"><?= $count++ ?></td>
                <?php if($t['leader_id'] == $t['user_id']): ?>
                <td>
                    <strong><?= ucfirst($t['name']) ?> | Leader</strong>
                    (<?= $t['phone_number'] ?>)
                </td>
                <?php else: ?>
                    <td><?= ucfirst($t['name']) ?></td>
                <?php endif; ?>

        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form action="/exit-team" method="post">
        <input type="text" hidden name="team_id" value="<?= $team[0]['team_id']?>">
        <button class="btn btn-danger">Exit team</button>
    </form>
</div>
<?= $this->endSection(); ?>
