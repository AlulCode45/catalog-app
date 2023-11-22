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
                                <form class="form form-horizontal" method="POST" action="<?= base_url('admin/category/save')?>">
                                    <div class="form-body">
                                        <input type="hidden" name="action" value="new">
                                        <div class="row">
                                            <div class="col-md-4 my-auto">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <input type="text" id="name" class="form-control" name="name" placeholder="Category name">
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-lg-12 form-group mb-2">
                                                <input type="text" id="description" class="form-control" name="description" placeholder="Category description">
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
<!-- 
<script>
    $(document).ready(function() {
        $("#category").select2()
    })
</script> -->