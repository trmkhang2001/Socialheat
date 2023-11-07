<?php
/**
 * @var $item
 */
$params = $this->config->config['params'];
$roles = $params['user_role'];
?>
<div class="row" id='vue-form'>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
                    <label>
                        <input type="hidden" name="id" value="<?php echo $item->id ?>" />
                    </label>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $item->name ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $item->email ?>"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="" minlength="6" value="<?php echo $item->id === 0 ? '123456' : ''?>"  />
							<small>Mật khẩu mặc đinh:123456	</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">SDT</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo $item->phone ?>"  />

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phân quyền</label>
                        <div class="col-sm-9">
                            <label class="field select">
                                <select name="role_id" class="form-control">
                                    <option value="">Chọn</option>
                                    <?php foreach ($roles as $role):?>
                                        <option value="<?php echo $role['id']?>"><?php echo $role['name']?></option>
                                    <?php endforeach;?>
                                </select>
                                <i class="arrow"></i>
                            </label>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" @click="saveComplete"  class="btn btn-primary"><i class="fa fa-save"></i> SAVE</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view('backend/layout/submit_form',['urlRedirect' => '/backend/users'])?>