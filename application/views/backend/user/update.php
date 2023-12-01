<?php

/**
 * @var $item
 * @var $title
 */
$params = $this->config->config['params'];
$roles = $params['user_role'];
?>
<div class="card mx-5 p-3 px-5">
    <h1><?= $title ?></h1>
    <div class="row" id='vue-form'>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
                        <label>
                            <input type="hidden" name="id" value="<?php echo $item->id ?>" />
                        </label>
                        <div class="mb-3 row my-5">
                            <label class="col-sm-2 control-label fw-bold">Họ tên</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $item->name ?>" />
                            </div>
                        </div>
                        <div class="mb-3 row my-5">
                            <label class="col-sm-2 control-label fw-bold">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $item->email ?>" />
                            </div>
                        </div>

                        <div class="mb-3 row my-5">
                            <label class="col-sm-2 control-label fw-bold">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="" minlength="6" value="<?php echo $item->id === 0 ? '123456' : '' ?>" />
                                <small>Mật khẩu mặc đinh:123456 </small>
                            </div>
                        </div>

                        <div class="mb-3 row my-5">
                            <label class="col-sm-2 control-label fw-bold">SDT</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo $item->phone ?>" />

                            </div>
                        </div>

                        <div class="mb-3 row my-5">
                            <label class="col-sm-2 control-label fw-bold">Phân quyền</label>
                            <div class="col-sm-10">
                                <label class="field select">
                                    <select name="role_id" class="form-select">
                                        <option value="">Chọn</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <i class="arrow"></i>
                                </label>

                            </div>
                        </div>
                        <div class="mb-3 row my-5">
                            <label class="col-sm-2 control-label fw-bold">Ngày hết hạn</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="expire_date" name="birthday">
                            </div>
                        </div>
                        <div class="mb-3 row my-5">
                            <div class="col-sm-10 col-sm-offset-3">
                                <button type="button" @click="saveComplete" class="btn btn-primary fw-bold"><i class="fa fa-save"></i> SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/users']) ?>