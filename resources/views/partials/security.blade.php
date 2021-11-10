<div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
    <form class="forms-sample" action="" method="POST">
        @csrf
        <div class="form-group row">
            <label for="newpass" class="col-sm-2 my-auto">Old Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Type your old password...">
            </div>
        </div>
        <div class="form-group row">
            <label for="newpass" class="col-sm-2 my-auto">New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Type new password...">
            </div>
        </div>
        <div class="form-group row">
            <label for="newpass" class="col-sm-2 my-auto">Re-Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="repass" name="repass" placeholder="Retype new password...">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm mt-2">Reset Password</button>
    </form>
</div>