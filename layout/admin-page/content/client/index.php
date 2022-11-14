        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><i class="fa fa-users"></i> Clients</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>ID#</th>
                  <th>Status</th>
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
                    <td><?php echo ($res['verified']) ? 'VERIFIED' : 'PENDING'; ?></td>
                    <td><?php echo ucfirst($res['branch']); ?></td>
                    <td><?php echo $res['username']; ?></td>
                    <td><?php echo $res['email']; ?></td>
                    <td><?php echo ucwords($res['first_name'] . ' ' . $res['last_name']); ?></td>
                    <td><?php echo strtoupper($res['gender']); ?></td>
                    <td><?php echo $res['contact_no']; ?></td>
                    <td>
                      <form method="post" name="update_client">

                        <?php if (in_array($_SESSION['user']->access_id, array(3, 4))) { ?>
                          <button type="button" class="btn btn-sm btn-dark btn-edit" name="admin/client_view" value="<?php echo $res['id']; ?>"> View <i class="fa fa-eye"></i> </button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-sm btn-dark btn-edit" name="admin/client_edit" value="<?php echo $res['id']; ?>"> Edit <i class="fa fa-edit"></i> </button>
                          <?php if (empty($res['verified'])) { ?>
                            <button type="submit" class="btn btn-sm btn-dark" name="verify" value="<?php echo $res['id']; ?>"> Verify <i class="fa fa-user-check"></i> </button>
                          <?php } else { ?>
                            <button type="button" class="btn btn-sm btn-dark" disabled> Verify <i class="fa fa-user-check"></i> </button>
                            <button type="submit" class="btn btn-sm btn-dark" name="delete" value="<?php echo $res['id']; ?>"> Delete <i class="fa fa-trash"></i> </button>
                          <?php } ?>
                        <?php } ?>

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
            buttons: [
              <?php if (in_array($_SESSION['user']->access_id, array(1, 2))) { ?> {
                  className: 'btn btn-sm btn-dark',
                  text: '<i class="fa fa-user-plus"></i> Add Client',
                  action: function(e, dt, node, config) {
                    $("#content").load(base_url + 'page.php?page=admin/client_add');
                  }
                }
              ]
          <?php } ?>
          });
        </script>