        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-hand-rock"></i> Add Workout</h1>
          </div><!-- /.col -->
        </div>
        <form method="post" name="create_workout">
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Workout Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">*Workout Name</label>
                      <input type="text" class="form-control" id="workout" name="workout" placeholder="Workout Name">
                    </div>
                    <div class="form-group">
                      <label for="">*Workout Reps</label>
                      <input type="number" class="form-control" id="reps" name="reps" placeholder="Workout Reps">
                    </div>
                    <div class="form-group">
                      <label for="">*Workout Sets</label>
                      <input type="number" class="form-control" id="sets" name="sets" placeholder="Workout Sets">
                    </div>
                    <div class="form-group">
                      <label for="">Workout Duration</label>
                      <textarea class="form-control" rows="4" id="duration" name="duration" placeholder="Workout Duration"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark float-right"><i class="fa fa-plus"></i> Add Workout</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </form>