        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-store"></i> Create Branch</h1>
          </div><!-- /.col -->
        </div>
        <form method="post" name="create_branch">
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Branch Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">*Branch Name</label>
                      <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name">
                    </div>
                    <div class="form-group">
                      <label for="">*Branch Description</label>
                      <textarea class="form-control" rows="4" id="description" name="description" placeholder="Branch Description"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark float-right"><i class="fa fa-plus"></i> Create Branch</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </form>