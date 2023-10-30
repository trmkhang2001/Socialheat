<div class="m-content">
	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__body">

			<!--/row-->
			<div class="row">
				<div class="col-12">
					<?php $msg = $this->session->flashdata('msg'); ?>
					<?php if (isset($msg)): ?>
						<div class="m-alert m-alert--square alert alert-success  alert-dismissible " style="width: 100%"> <?php echo $msg; ?> &nbsp;
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					<?php endif ?>

					<?php $error_msg = $this->session->flashdata('error_msg'); ?>
					<?php if (isset($error_msg)): ?>
						<div class="m-alert m-alert--square alert alert-danger  alert-dismissible " style="width: 100%"><?php echo $error_msg; ?> &nbsp;
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					<?php endif ?>
					<form class="m-form m-form--fit m-form--label-align-right" method="post">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
								<label for="example-text-input" class="col-3 col-form-label">Current password</label>
								<div class="col-9">
									<input class="form-control m-input" type="password" value="" id="example-text-input" name="current_password">
								</div>
							</div>

							<div class="form-group m-form__group row">
								<label for="example-email-input" class="col-3 col-form-label">New password</label>
								<div class="col-9">
									<input class="form-control m-input" type="password" id="example-email-input" name="new_password">
								</div>
							</div>
							<div class="form-group m-form__group row">
								<label for="example-email-input" class="col-3 col-form-label">Confirm password</label>
								<div class="col-9">
									<input class="form-control m-input" type="password" id="example-email-input" name="confirm_password">
								</div>
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-3">
									</div>
									<div class="col-9">
										<button type="submit" class="btn btn-success">Submit</button>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
					</form>

				</div>
			</div>
		</div>
	</div>
</div>