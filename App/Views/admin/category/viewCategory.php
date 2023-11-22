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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/category') ?>">Category</a></li>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;
                            foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= $category['category_name'] ?></td>
                                    <td><?= $category['category_description'] ?></td>
                                    <td>
                                        <div class="d-flex d-inline">
                                            <button class="btn btn-sm btn-danger mx-1" onclick="handleDelete('<?= $category['id'] ?>')">DELETE</button>
                                            <!-- <button class="btn btn-sm btn-primary mx-1">UPDATE</button> -->
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
            <form action="<?= base_url('admin/category/delete') ?>" method="post">
                <input type="hidden" name="categoryid" value="" id="categoryid">
                <div class="modal-body">
                    <p>Dengan ini saya setuju menghapus produk.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#products').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "responsive": true,
        });
    });

    function handleDelete(categoryid) {
        $(document).ready(function() {
            $("#categoryid").val(categoryid)
            $("#modal-delete").modal("show")
        })
    }
</script>