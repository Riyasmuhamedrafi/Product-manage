<div class="modal fade" id="modal-lg" save-action="{{route('subadmin.store')}}" token={{csrf_token()}}>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Sub Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        <small id="usercheck" class="form-text text-muted invalid-feedback">**Username is missing</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        <small id="emailcheck" class="form-text text-muted invalid-feedback">Your email must be a valid email</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        <small id="passwordcheck" class="form-text text-muted invalid-feedback">**Password error message</small>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        <small id="confirmpasswordcheck" class="form-text text-muted invalid-feedback">**Confirm Password error message</small>
                    </div>
                  <div class="form-group">
                    <label>Select</label>
                    <select class="form-control" name="status">
                      <option value="1">Active</option>
                      <option value="0">InActive</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary saveSubAdmin">Save changes</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
