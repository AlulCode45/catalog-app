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
                    <table id="discounts" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Percent</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;
                            foreach ($discounts as $discount) : ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= $discount['discount_name'] ?></td>
                                    <td><?= $discount['discount_description'] ?></td>
                                    <td><?= $discount['discount_percent'] ?>%</td>
                                    <td>
                                        <?php if ($discount['discount_active'] == 1): ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Inactive</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <div class="d-flex d-inline">
                                            <button class="btn btn-sm btn-danger mx-1" onclick="handleDelete('<?= $discount['id'] ?>')">DELETE</button>
                                            <button class="btn btn-sm btn-primary mx-1" onclick="handleStatus('<?= $discount['id'] ?>')">CHANGE STATUS</button>
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


<div class="modal fade" id="modal-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/discount/status') ?>" method="post">
                <input type="hidden" name="discountid" value="" id="discountid">
                <div class="modal-body">
                    <p>Dengan ini anda akan mengubah status diskon</p>
                    <select name="status" id="status" class="form-control">
                        <option value="0">Aktifkan</option>
                        <option value="1">Matikan</option>
                    </select>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
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
            <form action="<?= base_url('admin/discount/delete') ?>" method="post">
                <input type="hidden" name="discountid" value="" id="discountid-delete">
                <div class="modal-body">
                    <p>Dengan ini saya setuju mengubah status.</p>
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
        $('#discounts').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "responsive": true,
        });
    });
    
    function handleDelete(discountid) {
        $(document).ready(function() {
            $("#discountid-delete").val(discountid)
            $("#modal-delete").modal("show")
        })
    }

    function handleStatus(discountid) {
        $(document).ready(function() {
            $("#discountid").val(discountid)
            $("#modal-status").modal("show")
        })
    }
</script>