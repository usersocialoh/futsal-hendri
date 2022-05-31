<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>
    <h4 class="text-center"><?= $team[0]['team'] ?></h4>
    <p>Choose one person as a new leader :</p>
    <form action="<?= base_url('/assign-leader')?>" method="post">

        <input name="team_id" value="<?= $team[0]['team_id'] ?>" hidden>
        <?php $count = 1; ?>
        <?php foreach ($team as $t): ?>
            <div class="custom-control custom-radio">
                <input type="radio" id="<?= 'radio-'.$t['user_id'] ?>" name="leader_id" value="<?= $t['user_id'] ?>" class="custom-control-input">
                <label class="custom-control-label" for="<?= 'radio-'.$t['user_id'] ?>"><?= $t['name'] ?></label>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-primary my-3">Assign</button>
    </form>
</div>
<?= $this->endSection(); ?>
