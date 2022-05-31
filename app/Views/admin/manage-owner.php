<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4"><?= $title ?></h3>

    <?php if ($owner): ?>
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
            <?php foreach ($owner as $o): ?>
                <tr>
                    <td><?= ucfirst($o['name']) ?></td>
                    <td><?= strtolower($o['email']) ?></td>
                    <td><?= $o['phone_number'] ?></td>
                    <td><?= $o['team'] ? $o['team'] : '-';?></td>
                    <td><?= getFormattedDate($o['created_at']) ?></td>
                    <td>
                        <a class="badge badge-danger container p-2"
                           href="<?= base_url('/set-as-member/'. $o['user_id'])  ?>">Set as Member</a><br>
                        <a class="badge badge-primary container p-2"
                           href="<?= base_url('/set-as-admin/'. $o['user_id'])  ?>">Set as Admin</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>There is no owner yet</p>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
