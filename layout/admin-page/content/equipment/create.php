        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-dumbbell"></i> Add Equipment</h1>
          </div><!-- /.col -->
        </div>
        <form method="post" name="create_equipment">
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Equipment Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">*Equipment Name</label>
                      <input type="text" class="form-control" id="equipment" name="equipment" placeholder="Equipment Name">
                    </div>
                    <div class="form-group">
                      <label for="">*Equipment Qty</label>
                      <input type="number" class="form-control" id="qty" name="qty" placeholder="Equipment Qty">
                    </div>
                    <div class="form-group">
                      <label for="">*Equipment Description</label>
                      <textarea class="form-control" rows="4" id="description" name="description" placeholder="Equipment Description"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark float-right"><i class="fa fa-plus"></i> Add Equipment</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </form>