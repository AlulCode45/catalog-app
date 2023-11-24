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
                                <form class="form form-horizontal" method="POST" action="<?= base_url('admin/product/save')?>" enctype="multipart/form-data">
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
                                                <select name="category" id="category" class="form-control">
                                                    <option value="null">Product category</option>
                                                    <?php foreach ($categories as $category): ?>
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
                                                <label>Price</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <input type="number" id="price" class="form-control" name="price" placeholder="Product price">
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Discount</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <select name="discount" id="discount" class="form-control">
                                                    <option value="null">Product discount</option>
                                                    <?php foreach ($discounts as $discount): ?>
                                                        <option value="<?= $discount['id'] ?>"><?= $discount['discount_name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Image</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <!-- <div class="custom-file">
                                                    <input type="file" name="product_image" id="product_image" class="custom-file-input">
                                                    <label for="product_image" class="custom-file-label">PILIH FILE</label>
                                                </div> -->
                                                <input type="file" name="product_image" id="product_image" class="form-control-file">
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                                                <!-- <input type="text" id="description" class="form-control" name="description" placeholder="Product description"> -->
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
</script>