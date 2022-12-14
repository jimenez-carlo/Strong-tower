        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-pills"></i> Add Supplement</h1>
          </div><!-- /.col -->
        </div>
        <form method="post" name="create_supplement">
          <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Supplement Details</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">Image</label>
                      <img src="assets/supplements/default.png" alt="" style="width:200px;height:200px;align-self: center;" id="preview">
                      <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                      <label for="">*Supplement Name</label>
                      <input type="text" class="form-control" id="supplement" name="supplement" placeholder="Supplement Name">
                    </div>
                    <div class="form-group">
                      <label for="">*Supplement Price</label>
                      <input type="number" class="form-control" id="price" name="price" placeholder="Supplement Name">
                    </div>
                    <div class="form-group">
                      <label for="">*Supplement Qty</label>
                      <input type="number" class="form-control" id="qty" name="qty" placeholder="Supplement Name">
                    </div>
                    <div class="form-group">
                      <label for="">Supplement Description</label>
                      <textarea class="form-control" rows="4" id="description" name="description" placeholder="Supplement Description"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark float-right"><i class="fa fa-save"></i> Add Supplement</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </form>

        <script>
          inputImage = document.getElementById('image');
          preview = document.getElementById('preview');
          inputImage.onchange = evt => {
            const [file] = inputImage.files
            if (file && file['type'].split('/')[0] === 'image') {
              preview.src = URL.createObjectURL(file)
            } else {
              preview.src = 'assets/supplements/default.png';
            }
          }
        </script>