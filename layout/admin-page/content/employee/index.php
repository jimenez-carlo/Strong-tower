        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-users"></i> Employees</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>ID#</th>
                  <th>Branch</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Contact</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['users'] as $res) { ?>
                  <tr>
                    <td><?php echo $res['id']; ?></td>
                    <td><?php echo ucfirst($res['branch']); ?></td>
                    <td><?php echo $res['username']; ?></td>
                    <td><?php echo $res['email']; ?></td>
                    <td><?php echo ucwords($res['first_name'] . ' ' . $res['last_name']); ?></td>
                    <td><?php echo strtoupper($res['gender']); ?></td>
                    <td><?php echo $res['contact_no']; ?></td>
                    <td>
                      <?php if ($res['access_id'] == 1) { ?>
                        <button type="button" class="btn btn-sm btn-dark" disabled> Edit <i class="fa fa-edit"></i> </button>
                        <button type="button" class="btn btn-sm btn-dark" disabled> Delete <i class="fa fa-trash"></i> </button>
                    </td>
                  <?php } else { ?>
                    <form method="post" name="update_user">
                      <button type="button" class="btn btn-sm btn-dark btn-edit" name="user_edit" value="<?php echo $res['id']; ?>"> Edit <i class="fa fa-edit"></i> </button>
                      <input type="hidden" value="<?php echo $res['id']; ?>" name="user_id">
                      <button type="submit" class="btn btn-sm btn-dark" name="type" value="delete_user"> Delete <i class="fa fa-trash"></i> </button>
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
            buttons: [{
              className: 'btn btn-sm btn-dark',
              text: '<i class="fa fa-user-plus"></i> Add Employee',
              action: function(e, dt, node, config) {
                $("#content").load(base_url + 'page.php?page=client_add');
              }
            }]
          });
        </script>