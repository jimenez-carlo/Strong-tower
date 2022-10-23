        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-clipboard"></i> Membership Plans</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>ID#</th>
                  <th>Plan name</th>
                  <th>Monthly Price</th>
                  <th>Session Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['plans'] as $res) { ?>
                  <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo ucfirst($res['name']); ?></td>
                    <td class="text-right"><?php echo number_format($res['per_month'], 2); ?></td>
                    <td class="text-right"><?php echo number_format($res['per_session'], 2); ?></td>
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
              text: '<i class="fa fa-plus"></i> New Plan',
              action: function(e, dt, node, config) {
                $("#content").load(base_url + 'page.php?page=plan_add');
              }
            }]
          });
        </script>