<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4"><?= $title ?></h3>

    <?php if ($admin): ?>
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

            <?php foreach ($admin as $a): ?>
                <tr>
                    <td><?= ucfirst($a['name']) ?></td>
                    <td><?= strtolower($a['email']) ?></td>
                    <td><?= $a['phone_number'] ?></td>
                    <td><?= $a['team'] ? $a['team'] : '-';?></td>
                    <td><?= getFormattedDate($a['created_at']) ?></td>
                    <td>
                        <a class="badge badge-danger container p-2"
                           href="<?= base_url('/set-as-member/'.$a['user_id']); ?>">Set as Member</a><br>
                        <a class="badge badge-primary container p-2"
                           href="<?= base_url('/set-as-owner/'.$a['user_id']);  ?>">Set as Owner</a>
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
