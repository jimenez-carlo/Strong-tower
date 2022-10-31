<?php $default = $data['workout']; ?>
<div class="row mb-2">
  <div class="col-sm-12">
    <h1 class="m-0"><i class="fa fa-hand-rock"></i> Edit Workout #<?= $default->id ?></h1>
  </div><!-- /.col -->
</div>
<form method="post" name="update_workout">
  <input type="hidden" name="id" value="<?= $default->id ?>">
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
              <input type="text" class="form-control" id="workout" name="workout" placeholder="Workout Name" value="<?= $default->name ?>">
            </div>
            <div class="form-group">
              <label for="">*Workout Reps</label>
              <input type="number" class="form-control" id="reps" name="reps" placeholder="Workout Reps" value="<?= $default->reps ?>">
            </div>
            <div class="form-group">
              <label for="">*Workout Sets</label>
              <input type="number" class="form-control" id="sets" name="sets" placeholder="Workout Sets" value="<?= $default->sets ?>">
            </div>
            <div class="form-group">
              <label for="">Workout Duration</label>
              <textarea class="form-control" rows="4" id="duration" name="duration" placeholder="Workout Duration"><?= $default->duration ?></textarea>
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