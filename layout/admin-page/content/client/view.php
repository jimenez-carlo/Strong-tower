<?php $default = $data['client']; ?>
<div class="row mb-2">
  <div class="col-sm-12">
    <h1 class="m-0"><i class="fa fa-user"></i> View Client #<?= $default->id ?></h1>
  </div><!-- /.col -->
</div>
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Client Details</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="post" name="update_client">
            <input type="hidden" name="id" value="<?= $default->id ?>">

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" disabled value="<?= $default->username ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" disabled value="<?= $default->email ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Branch</label>
                  <?php if (in_array($_SESSION['user']->access_id, array(1))) { ?>
                    <select id="branch" name="branch" class="form-control">
                      <?php foreach ($data['branch'] as $res) { ?>
                        <option value="<?= $res['id']; ?>" <?php echo ($default->branch_id == $res['id']) ? 'selected' : ''; ?>><?= $res['name']; ?></option>
                      <?php } ?>
                    </select>
                  <?php } else { ?>
                    <input type="text" class="form-control" value="<?= $_SESSION['user']->branch ?>" disabled>
                    <input type="hidden" id="branch" name="branch" value="<?= $_SESSION['user']->branch_id ?>" disabled>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Gender</label>
                  <select id="gender" class="form-control custom-select" name="gender" disabled>
                    <?php foreach ($data['gender'] as $res) { ?>
                      <option value="<?= $res['id']; ?>" <?php echo ($default->gender_id == $res['id']) ? 'selected' : ''; ?>><?= $res['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Contact No#</label>
                  <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact No#" value="<?= $default->contact_no ?>" disabled>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label>Type</label>
                  <input type="text" class="form-control" value="Client" disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?= $default->first_name ?>" disabled>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Middle Name</label>
                  <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?= $default->middle_name ?>" disabled>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>*Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?= $default->last_name ?>" disabled>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-4">
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="4" id="address" name="address" placeholder="Address" disabled><?= $default->address ?></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <h3>Plan History</h3>
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Plan</th>
                      <th>Trainer</th>
                      <!-- <th>Email</th> -->
                      <th>Contact No#</th>
                      <th>Created Date</th>
                      <th>Expiration Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($data['plans'])) { ?>
                      <?php foreach ($data['plans'] as $res) { ?>
                        <tr>
                          <td><?php echo $res['id']; ?></td>
                          <td><?php echo $res['plan_name']; ?></td>
                          <td><?php echo ucwords($res['first_name'] . ' ' . $res['last_name']); ?></td>
                          <!-- <td><?php echo $res['email']; ?></td> -->
                          <td><?php echo $res['contact_no']; ?></td>
                          <td><?php echo $res['created_date']; ?></td>
                          <td><?php echo $res['expiration_date']; ?></td>
                        </tr>
                      <?php } ?>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>

            <div class="form-group">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Plan Details</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="post" name="update_client">
            <input type="hidden" name="id" value="<?= $default->id ?>">

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Plan</label>
                  <input type="text" class="form-control" value="<?= $default->name ?>" disabled>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Expiration Date</label>
                  <input type="text" class="form-control" value="<?= $default->plan_expiration_date ?>" disabled>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Session Price</label>
                  <input type="text" class="form-control" value="<?= $default->per_session ?>" disabled>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Monthly Price</label>
                  <input type="text" class="form-control" value="<?= $default->per_month ?>" disabled>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="4" disabled><?= $default->description ?></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                  <thead>
                    <tr>
                      <th>Workout</th>
                      <th>Reps</th>
                      <th>Sets</th>
                      <th>Duration</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($data['client_workout'])) { ?>
                      <?php foreach ($data['client_workout'] as $res) { ?>
                        <tr>
                          <td><?php echo ucfirst($res['name']); ?></td>
                          <td><?php echo $res['reps']; ?></td>
                          <td><?php echo $res['sets']; ?></td>
                          <td><?php echo ucfirst($res['duration']); ?></td>
                        </tr>
                      <?php } ?>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>