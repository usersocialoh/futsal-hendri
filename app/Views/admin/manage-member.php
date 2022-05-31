<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4"><?= $title ?></h3>

    <?php if ($member): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Team</th>
                <th scope="col">Date created</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($member as $m): ?>
                <tr>
                    <td><?= ucfirst($m['name']) ?></td>
                    <td><?= strtolower($m['email']) ?></td>
                    <td><?= $m['phone_number'] ?></td>
                    <td><?= $m['team'] ? $m['team'] : '-';?></td>
                    <td><?= getFormattedDate($m['created_at']) ?></td>
                    <td>
                        <a class="badge badge-danger container p-2"
                           href="<?= base_url('/set-as-admin/'.$m['user_id']) ?>">Set as Admin</a><br>
                        <a class="badge badge-primary container p-2"
                           href="<?= base_url('/set-as-owner/'.$m['user_id']) ?>">Set as Owner</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>There is no member yet</p>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
