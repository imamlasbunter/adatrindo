<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $h1; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <?= $breadcrumb; ?>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Alert saved -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">

                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title"><a class="btn btn-success" href="<?= base_url('menu/add') ?>">Add Menu</a></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input type="text" name="keyword" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Category Name</th>
                                        <th scope="col" rowspan="4">Menu Name</th>
                                        <th scope="col">sequence</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Parent Id</th>
                                        <th scope="col">Menu Icon</th>
                                        <th scope="col">Menu Lnik</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody> <?php
                                        $this->db = \Config\Database::connect();
                                        $main_menu = $this->db->query("SELECT a.*, b.name FROM tbl_menus a LEFT JOIN tbl_category_menus b ON b.id = a.category_menu WHERE a.parent_id =0  ORDER BY a.category_menu, a.sequence  asc");
                                        //looping main menu
                                        foreach ($main_menu->getresult() as $main) {
                                            //cari sub menu
                                            $sql_sub_menu = $this->db->query('SELECT a.*, b.name FROM tbl_menus a LEFT JOIN tbl_category_menus b ON b.id = a.category_menu WHERE parent_id = ' . $main->id . '  ORDER BY a.category_menu, a.sequence asc');
                                            $sub_menu = $sql_sub_menu->getresult();
                                            // periksa apakah ada sub menu
                                            $status = ($main->status == 'A') ? 'Aktif' : 'Non Aktif';
                                            if ($sql_sub_menu->getNumRows() > 0) {
                                                //tampilkan main menu
                                                echo '<tr>
                                                <td >' . $main->name . '</td>
                                                <td colspan="4">' . $main->menu_name . '</td>
                                                <td>' . $main->sequence . '</td>
                                                <td>' . $status . '</td>
                                                <td>' . $main->parent_id . '</td>
                                                <td>' . $main->icon_menu . '</td>
                                                <td>' . $main->link_menu . '</td>
                                                <td style="text-align:center"><a href="' . base_url('menu/add-submenu/' . $main->id) . '""><i class="fa fa-plus" aria-hidden="true"></i></a> | 
                                                <a href="' . base_url('menu/edit/' . $main->id) . '"><i class="fa fa-edit"></i></a> | 
                                                <a href="' . base_url('menu/delete/' . $main->id) . '"" onclick="return confirm(\'Anda yakin?\')"><i class="fa fa-trash"></i></a> </td>
                                                </tr>';
                                                //submenunya level 1
                                                foreach ($sub_menu as $submenu1) {
                                                    $status = ($submenu1->status == 'A') ? 'Aktif' : 'Non Aktif';
                                                    echo '<tr>
                                                        <td>' . $submenu1->name . '</td>
                                                        <td></td>
                                                        <td  colspan="3">' . $submenu1->menu_name . '</td>
                                                        <td>' . $submenu1->sequence . '</td>
                                                        <td>' . $status . '</td>
                                                        <td>' . $submenu1->parent_id . '</td>
                                                        <td>' . $submenu1->icon_menu . '</td>
                                                        <td>' . $submenu1->link_menu . '</td>
                                                        <td style="text-align:center">
                                                       
                                                        <a href="' . base_url('menu/edit/' . $submenu1->id) . '"><i class="fa fa-edit"></i></a> | 
                                                        <a href="' . base_url('menu/delete/' . $submenu1->id) . '"" onclick="return confirm(\'Anda yakin?\')"><i class="fa fa-trash"></i></a> </td>
                                                        </tr>';
                                                }
                                            } else {
                                                echo '<tr>
                                                <td>' . $main->name . '</td>
                                                <td colspan="4">' . $main->menu_name . '</td>
                                                <td>' . $main->sequence . '</td>
                                                <td>' . $status . '</td>
                                                <td>' . $main->parent_id . '</td>
                                                <td>' . $main->icon_menu . '</td>
                                                <td>' . $main->link_menu . '</td>
                                                <td style="text-align:center"><a class="btn btn-success btn-xs" href="' . site_url('menu/add-submenu/' . $main->id) . '""><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                <a class="btn btn-primary btn-xs" href="' . base_url('menu/edit/' . $main->id) . '"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-xs"href="' . base_url('menu/delete/' . $main->id) . '"" onclick="return confirm(\'Anda yakin?\')"><i class="fa fa-trash"></i></a> </td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                    <?php // $pager->links('menus', 'pagination') 
                    ?>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>