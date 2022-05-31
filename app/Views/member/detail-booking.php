<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>

    <div class="text-center">
        <h5><?= $field['field_name']?></h5>
        <p><?= $field['address'].', '
            .getAddress($field['subdistrict']).', '
            .getAddress($field['district']).', '
            .getAddress($field['city']).', '
            .getAddress($field['province'])?></p>
    </div>
    <table class="table">
        <tbody>
            <tr>
                <td style="width: 200px;">Status</td>
                <td style="width: 20px;">:</td>
                <td>
                    <?= ($booking['is_confirmed']==1)? 'Confirmed' : 'Not confirmed'; ?>
                </td>
            </tr>
            <tr>
                <td>Transaction date</td>
                <td>:</td>
                <td>
                    <?= $booking['created_at']; ?>
                </td>
            </tr>
            <tr>
                <td>Total price</td>
                <td>:</td>
                <td>
                    <?= rupiah($booking['total_price']); ?>
                </td>
            </tr>
            <tr>
                <td>Payment receipt</td>
                <td>:</td>
                <td>
                    <?php if ($booking['receipt_image']): ?>
                        <a target="_blank" href="<?= base_url('/assets/img/booking/'.$booking['receipt_image']) ?>">See receipt</a>
                    <?php elseif($booking['user_id'] == $user['user_id']): ?>
                        <form action="/upload-receipt" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="booking_id" value="<?= $booking['booking_id']?>" hidden>
                                <input type="file" class="form-control" name="receipt_image"
                                       id="receipt_image" required>
                            </div>
                            <button class="btn btn-primary">Upload</button>
                        </form>
                    <?php else: ?>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Field Number</th>
            <th scope="col">Time</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $count = 1; ?>
        <?php foreach ($detail_booking as $d): ?>
        <tr>
            <td style="width: 50px;"><?= $count++ ?></td>
            <td><?= ucfirst('Field '.toCharacter($d['field_number'])) ?></td>
            <td><?= $d['booking_time'].':00 - '.($d['booking_time']+1).':00' ?></td>
            <td><?= $d['booking_date'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
