        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-clipboard"></i> Create Membership Plan</h1>
          </div><!-- /.col -->
        </div>
        <form method="post" name="create_plan">
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Membership Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">*Plan Name</label>
                      <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Plan Name">
                    </div>
                    <div class="form-group">
                      <label for="">*Plan Session Price</label>
                      <input type="number" class="form-control" id="per_session" name="per_session" placeholder="Plan Session Price">
                    </div>
                    <div class="form-group">
                      <label for="">*Plan Monthly Price</label>
                      <input type="number" class="form-control" id="per_month" name="per_month" placeholder="Plan Monthly Price">
                    </div>
                    <div class="form-group">
                      <label for="">*Plan Description</label>
                      <textarea class="form-control" rows="4" id="description" name="description" placeholder="Branch Description"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark float-right"><i class="fa fa-save"></i> Create Plan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </form>