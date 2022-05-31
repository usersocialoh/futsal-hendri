<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php //dd($booked_time);?>
<form action="/booking-confirmation" method="post">
    <div class="container-fluid">
        <div class="container">
            <h3 class="mt-5 mb-5 text-center"><?= $title ?></h3>
            <input type="text" name="field_id" value="<?= $field['field_id']; ?>" hidden>
            <?php foreach ($available_date as $date): ?>
                <div class="row">
                    <h4 class="mb-3"><?= $date?></h4>
                </div>
                <div class="row mb-5">
                    <?php for ($i=0; $i<$field_number; $i++): ?>
                        <div class="col-lg-3 col-6">
                            <h5 class="mb-3">Field <?= toCharacter($i); ?></h5>
                            <?php foreach ($available_time as $time): ?>
                                <?php $temp = [
                                    "field_number" => $i,
                                    "booking_time" => $time,
                                    "booking_date" => $date
                                ]; ?>
                                <div class="form-check">
                                    <input class="form-check-input" name="time[]" type="checkbox" value="<?= $date.'__'.$time.'__'.$i ?>"
                                        <?php if(in_array($temp, $booked_time)): ?>
                                            disabled
                                        <?php endif; ?>
                                    >
                                    <label class="form-check-label">
                                        <?= $time.':00-'.($time+1).':00' ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-primary container-fluid">Book</button>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>
