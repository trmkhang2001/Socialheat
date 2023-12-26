<?php

/**
 * @var $users
 * @var $pagination
 * @var $branches
 *
 */
$params = $this->config->config['params'];
$roles = $params['user_role'];
?>
<div class="mx-5 p-3">
    <h1>User Management</h1>
    <div class="card mt-5">
        <div class="card-body pt-9 pb-2 s-2">
            <div class="mb-3 row">
                <div class="d-flex justify-content-start">
                    <a href="/backend/users/create" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <form action="">
                <div class="mb-3 row">
                    <label for="fw-bold" class="col-sm-2 col-form-label">FullName</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" value="<?= $userInfo['name'] ?>" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fw-bold" class="col-sm-2 col-form-label">Email Address*</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" value="<?= $userInfo['email'] ?>" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fw-bold" class="col-sm-2 col-form-label">Password*</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" value="********" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fw-bold" class="col-sm-2 col-form-label">Type*</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" value="<?= $roles[$userInfo['role_id']]['name']  ?>" readonly>
                    </div>
                </div>
                <div class="mb-3 row d-flex">
                    <div class="d-flex justify-content-end align-items-center gap-2 gap-lg-3">
                        <a href="/backend/dashboards" class="btn btn-sm fw-bold btn-secondary indicator-label"> Cancel</a>
                        <a href="" class="btn btn-sm fw-bold btn-primary"> Save Changes</a>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Container-->
    </div>
</div>
<div class="row mx-5 p-3">
    <div class="card p-5">
        <div class="col-md-12">
            <div class="panel">
                <div class="d-flex">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col">
                                <label for="fw-bold" class="text-system fs-3 fw-bold mb-3">Phân quyền</label>
                                <div class="form-inline">
                                    <select name="role_id" class="form-select">
                                        <option value="">Chọn</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="fw-bold" class="text-system fs-3 fw-bold mb-3">Từ khóa</label>
                                <div class="form-inline">
                                    <input type="text" name="keyword" class="form-control " value="" placeholder="Tên, email, sdt">
                                </div>
                            </div>
                            <div class="col">
                                <label class="text-system"> &nbsp;</label>
                                <div class="form-inline mt-5">
                                    <button type="submit" class="btn btn-secondary "><i class="fa fa-filter"></i> Lọc dữ liệu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mx-5 p-3">
    <div class="card">
        <div class="col-md-12">
            <div class="panel">
                <div class="p-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="active fs-3 fw-bold">
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Key</th>
                                    <th>App Name</th>
                                    <th width="170">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) :
                                    $app_name = null;
                                    if ($user->app_id)
                                        foreach ($apps as $app) {
                                            if ($user->app_id == $app->id)
                                                $app_name = $app->app_name;
                                        }
                                ?>
                                    <tr>
                                        <td><?php echo $user->name ?></td>
                                        <td><?php echo $user->email ?></td>
                                        <td><span class="fw-bold badge badge-blue px-4 showData" data-decode="<?= $user->key ?>">
                                                <span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1" style="color: #5c98ff;">
                                                    <i class="fa-solid fa-eye fa-beat me-2" style="color: #5c98ff;"></i>Show
                                                </span>
                                            </span></td>
                                        <td><?php echo $app_name ?></td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><a href="/backend/users/update/<?php echo $user->id ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
                                                <li class="list-inline-item"><a href="/backend/users/delete/<?php echo $user->id ?>" class="btn btn-delete btn-danger"><i class="fa-solid fa-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <?php echo $pagination ?>
        </div>
    </div>
</div>