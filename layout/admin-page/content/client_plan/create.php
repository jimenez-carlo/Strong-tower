        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-user-plus"></i> Assign Client Plan</h1>
          </div><!-- /.col -->
        </div>
        <form method="post" name="create_client_plan">
          <section class="content">
            <div class="row">
              <div class="col-md-6">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Client Plan Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>*Plan</label>
                          <select id="plan" name="plan" class="form-control">
                            <?php foreach ($data['plans'] as $res) { ?>
                              <option value="<?= $res['id']; ?>"><?= strtoupper($res['name'] . ' - ' . $res['per_session'] . ' per session, ' . $res['per_month'] . ' per month'); ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>*Client</label>
                          <select id="client" name="client" class="form-control">
                            <?php foreach ($data['client'] as $res) { ?>
                              <option value="<?= $res['id']; ?>"><?= strtoupper($res['first_name'] . ' ' . $res['middle_name'][0] . '. ' . $res['last_name'] . ' - ' . $res['branch']); ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>*Trainer</label>
                          <select id="trainer" name="trainer" class="form-control">
                            <?php foreach ($data['trainer'] as $res) { ?>
                              <option value="<?= $res['id']; ?>"><?= strtoupper($res['first_name'] . ' ' . $res['middle_name'][0] . '. ' . $res['last_name'] . ' - ' . $res['branch']); ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>*Expiration Date</label>
                          <input type="date" class="form-control" name="expiration_date" id="expiration_date">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Workouts Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">


                    <div id="wrapper2">


                    </div>


                    <div class="form-group">
                      <button type="button" class="btn btn-dark" id="add_workout">
                        <i class="fas fa-plus"></i> Add Workout
                      </button>
                      <button type="submit" class="btn btn-dark float-right"><i class="fa fa-save"></i> Assign Client Plan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </form>

        <script>
          $(document).ready(function() {
            var wrapper = $("#wrapper2");
            var add_button = $("#add_workout");

            $(add_button).click(function(e) {
              e.preventDefault();
              $(wrapper).append('<div class="row"> <div class="col-sm-12"> <div class="form-group"> <label>Workout</label><div class="input-group"> <select name = "workout[]" class="form-control"><?php foreach ($data['workout'] as $res) { ?> <option value="<?= $res['id']; ?>" > <?= strtoupper($res['name'] . ' - ' . $res['reps'] . ' Reps - ' . $res['sets'] . ' Sets - ' . $res['duration'] . ' Duration'); ?> </option><?php } ?> </select> <span class="input-group-append"> <button type ="button" class="btn btn-dark btn-remove-workout" > Remove </button> </span></div> </div></div>');
            });

            $(wrapper).on("click", ".btn-remove-workout", function(e) {
              e.preventDefault();
              $(this).parent().parent().parent().parent().parent().remove();
            })
          });
        </script>