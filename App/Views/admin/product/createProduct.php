<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>">Product</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row match-height">
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $title ?></h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" onsubmit="submitForm()" method="POST" action="<?= base_url('admin/product/save') ?>" enctype="multipart/form-data">
                                    <div class="alert alert-dismissible fade show" role="alert" style="background-color:rgba(237, 237, 6, 0.50)">
                                        <p class="text-dark font-weight-light">Saat mengupload gambar disarankan menggunakan ukuran 512 x 512. Dengan panjang 512 pixel dan lebar 512 pixel.</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="form-body">
                                        <input type="hidden" name="action" value="new">
                                        <div class="row">
                                            <div class="col-md-4 my-auto">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <input type="text" id="name" class="form-control" name="name" placeholder="Product name">
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Category</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <select name="category" id="category" class="form-control" required>
                                                    <option value="">Product category</option>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Stock</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <input type="number" id="stock" class="form-control" name="stock" placeholder="Product stock">
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <input type="text" id="price" class="form-control" name="price" placeholder="Product price">
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Image</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="product_image[]" id="product_image" class="custom-file-input" multiple>
                                                    <label for="product_image" class="custom-file-label" id="file-label">PILIH FILE</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= base_url('plugins/ckeditor/ckeditor.js') ?>"></script>
<script>
    CKEDITOR.replace("description")

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('price');
    dengan_rupiah.addEventListener('keyup', function(e) {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    // Submit form function
    function submitForm() {
        // Remove non-numeric characters from the price field before submitting
        var priceInput = document.getElementById('price');
        priceInput.value = priceInput.value.replace(/[^0-9]/g, '');

        // You can add additional validation or form submission logic here if needed

        // Submit the form
        document.forms[0].submit(); // Assuming this is the only form on the page
    }

    document.getElementById('product_image').addEventListener('change', function() {
        var files = this.files;
        var label = document.getElementById('file-label');
        var labelText = 'PILIH FILE';

        if (files.length > 0) {
            labelText = '';
            for (var i = 0; i < files.length; i++) {
                labelText += files[i].name;
                if (i < files.length - 1) {
                    labelText += ', ';
                }
            }
        }

        label.innerHTML = labelText;
    });
</script>