        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-handshake"></i> Services</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>ID#</th>
                  <th>Image</th>
                  <th>Service name</th>
                  <?php if (in_array($_SESSION['user']->access_id, array(1, 2))) { ?>
                    <th>Actions</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['supplements'] as $res) { ?>
                  <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><img src="assets/services/<?php echo $res['image']; ?>" style="width:100px;height:100px;object-fit:contain"></td>
                    <td><?php echo ucfirst($res['name']); ?></td>
                    <?php if (in_array($_SESSION['user']->access_id, array(1, 2))) { ?>
                      <td>
                        <form method="post" name="update_service">
                          <button type="button" class="btn btn-sm btn-dark btn-edit" name="admin/service_edit" value="<?php echo $res['id']; ?>"> Edit <i class="fa fa-edit"></i> </button>
                          <button type="submit" class="btn btn-sm btn-dark" name="delete" value="<?php echo $res['id']; ?>"> Delete <i class="fa fa-trash"></i> </button>
                        </form>
                      </td>
                    <?php } ?>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>



        </div>

        </div><!-- /.row -->
        <script>
          $('table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            dom: '<"top"<"left-col"B><"center-col"><"right-col"f>> <"row"<"col-sm-12"tr>><"row"<"col-sm-10"li><"col-sm-2"p>>',
            buttons: [

              <?php if (in_array($_SESSION['user']->access_id, array(1, 2))) { ?> {
                  className: 'btn btn-sm btn-dark',
                  text: '<i class="fa fa-plus"></i> Add Service',
                  action: function(e, dt, node, config) {
                    $("#content").load(base_url + 'page.php?page=admin/services_add');
                  }
                }
              <?php } ?>
            ]
          });
        </script>