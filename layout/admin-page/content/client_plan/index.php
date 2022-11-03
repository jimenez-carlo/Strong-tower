        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-users"></i> Client Plans</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>Plan ID#</th>
                  <th>Plan</th>
                  <th>Branch</th>
                  <th>Client Name</th>
                  <th>Trainer Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Contact</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['users'] as $res) { ?>
                  <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo strtoupper($res['plan']); ?></td>
                    <td><?php echo ucfirst($res['branch']); ?></td>
                    <td><?php echo ucwords($res['first_name'] . ' ' . $res['middle_name'][0] . '. ' . $res['last_name']); ?></td>
                    <td><?php echo ucwords($res['t_first_name'] . ' ' . $res['t_middle_name'][0] . '. ' . $res['t_last_name']); ?></td>
                    <td><?php echo $res['email']; ?></td>
                    <td><?php echo strtoupper($res['gender']); ?></td>
                    <td><?php echo $res['contact_no']; ?></td>
                    <td>
                      <form method="post" name="update_client_plan">
                        <button type="button" class="btn btn-sm btn-dark btn-edit" name="admin/client_plan_edit" value="<?php echo $res['id']; ?>"> Edit <i class="fa fa-edit"></i> </button>
                        <button type="submit" class="btn btn-sm btn-dark" name="delete" value="<?php echo $res['id']; ?>"> Delete <i class="fa fa-trash"></i> </button>
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
              text: '<i class="fa fa-plus"></i> Add Client Plan',
              action: function(e, dt, node, config) {
                $("#content").load(base_url + 'page.php?page=admin/client_plan_add');
              }
            }]
          });
        </script>