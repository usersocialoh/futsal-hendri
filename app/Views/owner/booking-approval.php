<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>

    <?php if(count($booking) > 0): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                <th scope="col">Booking date</th>
                <th scope="col">Status</th>
                <th scope="col">Receipt Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            <?php foreach ($booking as $b): ?>
                <tr>
                    <td style="width: 50px;"><?= $count++ ?></td>
                    <td><?= ucfirst($b['name']) ?></td>
                    <td><?= ucfirst($b['email']) ?></td>
                    <td><?= ucfirst($b['phone_number']) ?></td>
                    <td><?= getFormattedDate($b['created_at']) ?></td>
                    <td><?= ($b['is_confirmed']==1)? 'Confirmed' : 'Not confirmed'; ?></td>
                    <td>
                        <?php if($b['receipt_image']):?>
                            <a target="_blank" href='<?= base_url('assets/img/booking/'.$b['receipt_image']) ?>'>See receipt</a>
                        <?php else: ?>
                            No image
                        <?php endif;?>
                    </td>
                    <td><a href="<?= base_url('/approve/'.$b['booking_id']); ?>">Approve</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">There is no unconfirmed booking.</p>
    <?php endif; ?>

</div>
<?= $this->endSection(); ?>
