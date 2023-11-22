<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link">
                        <i class="nav-icon fas fa-rocket"></i>
                        <p>
                            Go to site
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/product/create') ?>" class="nav-link">
                                <p>New product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/product/view') ?>" class="nav-link">
                                <p>View product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/category/create') ?>" class="nav-link">
                                <p>New category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/category/view') ?>" class="nav-link">
                                <p>View category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-percentage"></i>
                        <p>
                            Discount
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/discount/create') ?>" class="nav-link">
                                <p>New discount</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/discount/view') ?>" class="nav-link">
                                <p>View discount</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Page
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin') ?>" class="nav-link">
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <p>Hubungi kami</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <p>Sosial media</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/users') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/settings') ?>" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
                <?php if (session()->get("login") == true): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('logout') ?>" class="nav-link">
                            <i class="nav-icon fa fa-arrow-right"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</aside>