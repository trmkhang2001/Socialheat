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

<div class="row">
    <div class="col-md-12">
        <div  class="panel">
            <div class="">
                <form method="get" action="">
                    <div class="form-inline">

                        <div class="form-group">
                            <label class="text-system">Phân quyền</label>
                            <div class="form-inline">
                                    <select name="role_id" class="form-control">
                                        <option value="">Chọn</option>
                                        <?php foreach ($roles as $role):?>
                                            <option value="<?php echo $role['id']?>"><?php echo $role['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-system">Từ khóa</label>
                            <div class="form-inline">
                                <input type="text" name="keyword" class="form-control " value="" placeholder="Tên, email, sdt">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-system"> &nbsp;</label>
                            <div class="form-inline">
                                <button type="submit" class="btn btn-default "><i class="fa fa-filter"></i> Lọc dữ liệu</button>

                            </div>

                        </div>
                        <div class="form-group pull-right">
                            <label class="text-system"> &nbsp;</label>
                            <div class="form-inline">
                                <a href="/backend/users/create" class="btn btn-primary btn-default ">Tạo nhân viên</a>

                            </div>

                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="active ">
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Phân quyền</th>
                        <th width="170">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($users as $user):
                        $role = $roles[$user->role_id]
                        ?>
                        <tr>
                            <td><?php echo $user->name?></td>
                            <td><?php echo $user->email?></td>
                            <td><?php echo $role['name'] ?></td>
                            <td>
                                <ul class="list-inline">
                                    <li><a href="/backend/users/update/<?php echo $user->id?>" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
                                    <li><a href="/backend/users/delete/<?php echo $user->id?>" class="btn btn-delete btn-danger"><i class="fa fa-trash-o"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?php echo $pagination?>
    </div>
</div>