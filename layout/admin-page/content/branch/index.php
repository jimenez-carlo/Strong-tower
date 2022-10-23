        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-store"></i> Branches</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>ID#</th>
                  <th>Branch</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['branches'] as $res) { ?>
                  <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo ucfirst($res['name']); ?></td>
                    <td>

                      <form method="post" name="update_user">
                        <button type="button" class="btn btn-sm btn-dark btn-edit" name="user_edit" value="<?php echo $res['id']; ?>"> Edit <i class="fa fa-edit"></i> </button>
                        <input type="hidden" value="<?php echo $res['id']; ?>" name="user_id">
                        <button type="submit" class="btn btn-sm btn-dark" name="type" value="delete_user"> Delete <i class="fa fa-trash"></i> </button>
                      </form>
                    </td>

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
            buttons: [{
              className: 'btn btn-sm btn-dark',
              text: '<i class="fa fa-plus"></i> Add Branch',
              action: function(e, dt, node, config) {
                $("#content").load(base_url + 'page.php?page=branch_add');
              }
            }]
          });
        </script>