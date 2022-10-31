<?php $default = $data['trainer']; ?>
<div class="row mb-2">
  <div class="col-sm-12">
    <h1 class="m-0"><i class="fa fa-user"></i> Edit Trainer #<?= $default->id ?></h1>
  </div><!-- /.col -->
</div>
<form method="post" name="update_trainer">
  <input type="hidden" name="id" value="<?= $default->id ?>">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Trainer Details</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $default->username ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $default->email ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Branch</label>
                  <select id="branch" name="branch" class="form-control">
                    <?php foreach ($data['branch'] as $res) { ?>
                      <option value="<?= $res['id']; ?>" <?php echo ($default->branch_id == $res['id']) ? 'selected' : ''; ?>><?= $res['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Old Password">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label>Type</label>
                  <input type="text" class="form-control" value="Trainer" disabled>
                  <input type="hidden" id="access" name="access" value="3">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?= $default->first_name ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Middle Name</label>
                  <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?= $default->middle_name ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?= $default->last_name ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Gender</label>
                  <select id="gender" class="form-control custom-select" name="gender">
                    <?php foreach ($data['gender'] as $res) { ?>
                      <option value="<?= $res['id']; ?>" <?php echo ($default->gender_id == $res['id']) ? 'selected' : ''; ?>><?= $res['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Contact No#</label>
                  <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact No#" value="<?= $default->contact_no ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="4" id="address" name="address" placeholder="Address"><?= $default->address ?></textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-dark float-right"><i class="fa fa-arrow-up"></i> Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>