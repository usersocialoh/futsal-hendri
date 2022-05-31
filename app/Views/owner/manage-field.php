<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<form action="/manage-field" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <h3 class="mt-5 mb-4"><?= $title ?></h3>
        <?= $validation->listErrors() ?>
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-3 col-12">
                <img class="product-img" src="<?= base_url('/assets/img/field/'.$field['field_image']) ?>" alt="" style="width:100%;height:auto">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-9 col-12">
                <div class="text-left">
                    <input class="form-control" type="text" name="field_id" value="<?= $field['field_id']; ?>" hidden required>
                    <div class="form-group">
                        <label for="field_name">Field name</label>
                        <input type="text" class="form-control" name="field_name"
                               id="field_name" value="<?= $field['field_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="number_of_fields">Number of fields</label>
                        <input type="number" class="form-control" name="number_of_fields"
                               id="number_of_fields" value="<?= $field['number_of_fields']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="number_of_fields">Price</label>
                        <input type="number" class="form-control" name="price" step="5000" min="0"
                               id="price" value="<?= $field['price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="province">Select province</label>
                        <select class="form-control" id="province" name="province" onchange="changeProvince();" required>
                            <option selected disabled>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">Select city</label>
                        <select class="form-control" id="city" name="city" onchange="changeCity();" required>
                            <option selected disabled>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district">Select district</label>
                        <select class="form-control" id="district" name="district" onchange="changeDistrict();" required>
                            <option selected disabled>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="province">Select subdistrict</label>
                        <select class="form-control" id="subdistrict" name="subdistrict" required>
                            <option selected disabled>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address"
                               id="address" value="<?= $field['address']; ?>" required>
                    </div>
                    <?php if($field['field_image']!= 'default.jpg'): ?>
                        <input type="text" name="has_image" value="true" hidden>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Picture</label>
                        <input type="file" class="form-control-file" id="field_image" name="field_image">
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-primary btn-block my-4">Edit</button>
            </div>
        </div>
    </div>
</form>


<script type="text/javascript">
    let isFirstTime = true;
    let oldProvince = '<?= $field['province'] ?>';
    let oldCity = '<?= $field['city'] ?>';
    let oldDistrict = '<?= $field['district'] ?>';
    let oldSubdistrict = '<?= $field['subdistrict'] ?>';
    getProvince();
    function getProvince(){
        let url = 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
        $.get(url, {}, function(response){
            let element = `<option selected disabled>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#province').html(element);
            if(oldProvince !== '') {
                $(`#province option[value='${oldProvince}']`).attr('selected','selected');
                $('#province').change();
            }
        });
    }

    function changeProvince(){
        reset('city');
        reset('district');
        reset('subdistrict');
        let provinceId = getId('province');
        let url = `http://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`;
        $.get(url, {}, function(response){
            let element = `<option selected disabled>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#city').html(element);
            if(isFirstTime) {
                $(`#city option[value='${oldCity}']`).attr('selected','selected');
                $('#city').change();
            }
        });
    }

    function changeCity(){
        reset('district');
        reset('subdistrict');
        let cityId = getId('city');
        let url = `http://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`;
        $.get(url, {}, function(response){
            let element = `<option selected disabled>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#district').html(element);
            if(isFirstTime) {
                $(`#district option[value='${oldDistrict}']`).attr('selected','selected');
                $('#district').change();
            }
        });
    }

    function changeDistrict(){
        reset('subdistrict');
        let districtId = getId('district');
        let url = `http://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`;
        $.get(url, {}, function(response){
            let element = `<option selected disabled>...</option>`;
            response.forEach((data) => {
                element += `<option value="${capital(data.name)}__${data.id}">${capital(data.name)}</option>`;
            });
            $('#subdistrict').html(element);
            if(isFirstTime) {
                $(`#subdistrict option[value='${oldSubdistrict}']`).attr('selected','selected');
                $('#subdistrict').change();
                isFirstTime = false;
            }
        });
    }

    function capital(sentence) {
        sentence = sentence.toLowerCase();
        let words = sentence.split(" ").map(word => {
            return word[0].toUpperCase() + word.slice(1);
        })
        return words.join(" ");
    }

    function reset(element) {
        $(`#${element}`).html(`<option selected disabled>...</option>`);
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
