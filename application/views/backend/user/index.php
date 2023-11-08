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
                        <select name="type" id="type" class="form-select form-select-lg mb-3">
                            <option value="ADMIN">ADMIN</option>
                        </select>
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