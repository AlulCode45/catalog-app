<?php

use App\Models\CategoryModel;
use App\Models\DiscountModel;

function findCategory($id)
{
    $categoryModel = new CategoryModel();
    $categoryData = $categoryModel->where("id", $id)->first();
    if ($categoryData) {
        return $categoryData['category_name'];
    } else {
        return "Tidak diketahui";
    }
}

?>
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
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow">
                <div class="card-body">
                    <table id="products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;
                            foreach ($products as $product) :
                                $price = number_format($product['data_product']['product_price'], 0, ",", ".");
                                $image = $product['images'];
                            ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><img src="<?= $image[0]['image'] ?? '' ?>" alt="Gambar produk" class="thumbnail" style="width:64px;height:64px;"></td>
                                    <td><?= $product['data_product']['product_name'] ?></td>
                                    <td><?= $product['data_product']['product_description'] ?></td>
                                    <td><?= findCategory($product['data_product']['product_category']) ?></td>
                                    <td><?= $price ?></td>
                                    <td><?= $product['data_product']['product_stock'] ?></td>
                                    <td>
                                        <div class="d-flex d-inline">
                                            <button class="btn btn-sm btn-danger mx-1" onclick="handleDelete('<?= $product['data_product']['id'] ?>')">DELETE</button>
                                            <a href="<?= base_url('/admin/product/update/' . $product['data_product']['id']) ?>"><button class="btn btn-sm btn-primary mx-1">UPDATE</button></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/product/delete') ?>" method="post">
                <input type="hidden" name="productid" value="" id="productid">
                <div class="modal-body">
                    <p>Dengan ini saya setuju menghapus produk.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(function() {
        $('#products').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "responsive": true,
        });
    });

    function handleDelete(productid) {
        $(document).ready(function() {
            $("#productid").val(productid)
            $("#modal-delete").modal("show")
        })
    }
</script>