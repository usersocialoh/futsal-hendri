<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>

    <?php if(count($booking) > 0): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Field Name</th>
                <th scope="col">Total Price</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            <?php foreach ($booking as $b): ?>
            <tr>
                <td style="width: 50px;"><?= $count++ ?></td>
                <td><?= ucfirst($b['field_name']) ?></td>
                <td><?= rupiah($b['total_price']) ?></td>
                <td><?= ($b['is_confirmed']==1)? 'Confirmed' : 'Not confirmed'; ?></td>
                <td><a href="<?= base_url('/detail-booking/'.$b['booking_id']); ?>">see detail</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">There is no transaction history.</p>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
