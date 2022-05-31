<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <a href="<?= base_url('create-team'); ?>">Create team</a>
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>
    <?php if(count($team) > 0): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Team</th>
                <th scope="col">Member's count</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach ($team as $t): ?>
                    <td><?= $t['team'] ?></td>
                    <td><?= $t['count'] ?></td>
                    <td><a href="<?= base_url('join-team/'.$t['team_id']) ?>">Join team</a></td>
                <?php endforeach; ?>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
    <p class="text-center">No team registered yet.</p>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
