<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4 text-center"><?= $title ?></h3>
    <div class="mb-4">
        <div class="row justify-content-center">
            <div class="form-group col-12">
                <label for="province">Search address</label>
                <input class="form-control" type="text" id="search-field">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group col-6 col-lg-3">
                <label for="province">Select province</label>
                <select class="form-control" id="province" name="province" required>
                    <option selected disabled value="">...</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="city">Select city</label>
                <select class="form-control" id="city" name="city" required>
                    <option selected disabled value="">...</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="district">Select district</label>
                <select class="form-control" id="district" name="district" required>
                    <option selected disabled value="">...</option>
                </select>
            </div>
            <div class="form-group col-6 col-lg-3">
                <label for="province">Select subdistrict</label>
                <select class="form-control" id="subdistrict" name="subdistrict" required>
                    <option selected disabled value="">...</option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center mt-1">
            <a id="remove-btn" class="text-danger remove-btn">remove filter</a>
        </div>
    </div>
    <div class="row" id="item-container">
        <?php foreach ($field as $f): ?>
            <div class="col-lg-4 col-6">
                <a href="<?= base_url('field/'.$f['field_id']);?>">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= base_url('/assets/img/field/'.$f['field_image']); ?>" alt="..." width="100%">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $f['field_name']?></h5>
                                    <p class="card-text"><?= $f['address'].', '
                                        .getAddress($f['subdistrict']).', '
                                        .getAddress($f['district']).', '
                                        .getAddress($f['city']).', '
                                        .getAddress($f['province'])?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<script type="text/javascript">
    function removeFilter() {
        $('#search-field').val('');
        reset('province');
        reset('city');
        reset('district');
        reset('subdistrict');
        getProvince();
    }

    function liveSearch(){
        var keywords = $('#search-field').val();
        var province = $('#province').val();
        var city = $('#city').val();
        var district = $('#district').val();
        var subdistrict = $('#subdistrict').val();
        console.log(keywords,
            province,
            city,
            district,
            subdistrict);
        $.post('<?= base_url('find-field/filter') ?>',{
            keywords,
            province,
            city,
            district,
            subdistrict
        }, function(data){
            $('#item-container').html(data);
        });
    }

    $("#search-field").on("keyup", liveSearch);
    $("#province").on("change", changeProvince);
    $("#city").on("change", changeCity);
    $("#district").on("change", changeDistrict);
    $("#subdistrict").on("change", liveSearch);
    $("#remove-btn").on("click", removeFilter);

    getProvince();
    function getProvince(){
        let url = 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
        $.get(url, {}, function(response){
            let element = `<option selected disabled value=''>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#province').html(element);
            liveSearch();
        });
    }

    function changeProvince(){
        reset('city');
        reset('district');
        reset('subdistrict');
        let provinceId = getId('province');
        let url = `http://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`;
        $.get(url, {}, function(response){
            let element = `<option selected disabled value=''>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#city').html(element);
        });
        liveSearch();
    }

    function changeCity(){
        reset('district');
        reset('subdistrict');
        let cityId = getId('city');
        let url = `http://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`;
        $.get(url, {}, function(response){
            let element = `<option selected disabled value=''>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#district').html(element);
        });
        liveSearch();
    }

    function changeDistrict(){
        reset('subdistrict');
        let districtId = getId('district');
        let url = `http://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`;
        $.get(url, {}, function(response){
            let element = `<option selected disabled value=''>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#subdistrict').html(element);
        });
        liveSearch();
    }

    function capital(sentence) {
        sentence = sentence.toLowerCase();
        let words = sentence.split(" ").map(word => {
            return word[0].toUpperCase() + word.slice(1);
        })
        return words.join(" ");
    }

    function reset(element) {
        $(`#${element}`).html(`<option selected disabled value="">...</option>`);
    }

    function toId(text) {
        return text.replace(' ', '-');
    }
    function getId(element) {
        return $(`#${element}`).val().split('__')[1];
    }
    function getIdFromText(text) {
        return text.split('__')[1];
    }
</script>
<?= $this->endSection(); ?>
