<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>

    <?php if(count($owner) > 0): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                <th scope="col">Message</th>
                <th scope="col">Request date</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            <?php foreach ($owner as $o): ?>
                <tr>
                    <td style="width: 50px;"><?= $count++ ?></td>
                    <td><?= ucfirst($o['name']) ?></td>
                    <td><?= ucfirst($o['email']) ?></td>
                    <td><?= ucfirst($o['phone_number']) ?></td>
                    <td><?= $o['message'] ?></td>
                    <td><?= getFormattedDate($o['created_at']) ?></td>
                    <td>
                        <?php if($o['status']==0):?>
                            <a class="badge badge-primary py-2 px-3"
                               href="<?= base_url('/approve-owner/'.$o['owner_request_id']); ?>">Approve</a>
                            <a class="badge badge-danger py-2 px-3"
                               href="<?= base_url('/reject-owner/'.$o['owner_request_id']); ?>">Reject</a>
                        <?php elseif($o['status']==1): ?>
                            Approved
                        <?php else: ?>
                            Rejected
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">There is no unconfirmed booking.</p>
    <?php endif; ?>

</div>
<?= $this->endSection(); ?>
