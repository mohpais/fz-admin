<div class="modal fade" id="modal" tabindex="-1" data-backdrop="static" aria-labelledby="modal-showLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-2">
            <form class="forms-modal" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-showLabel"></h5>
                    <button id="dismiss" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="corporate_id" name="corporate_id">
                    <input type="hidden" id="current" name="current">
                    <div class="form-group">
                        <label for="name">Corporate Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <label id="name_error" class="error mt-2 text-danger d-none" for="name"></label>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                        <label id="position_error" class="error mt-2 text-danger d-none" for="position"></label>
                    </div>
                    <div class="form-group row mb-0">
                        <div id="col-join" class="col">
                            <label for="join_at">Join At</label>
                            <input type="text" class="form-control joindate datetimepicker-input" id="join_at" name="join_at" data-toggle="datetimepicker" data-target=".joindate" autocomplete="off" required>
                            <label id="join_at_error" class="error mt-2 text-danger d-none" for="join_at"></label>
                        </div>
                        <div id="col-resign" class="col">
                            <label for="resign_at">Resign At</label>
                            <input type="text" class="form-control resigndate datetimepicker-input" id="resign_at" name="resign_at" data-toggle="datetimepicker" data-target=".resigndate" autocomplete="off" required>
                            <label id="resign_at_error" class="error mt-2 text-danger d-none" for="resign_at"></label>
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <label class="form-check-label">
                            <input id="current_work" type="checkbox" class="form-check-input"> 
                            Current work <i class="input-helper"></i>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="job_description">Job Description</label>
                        <textarea id="jobdesc" class="my-desc form-control" name="jobdesc" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="dismiss" type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-gradient-primary btn-submit"></button>
                </div>
            </form>
        </div>
    </div>
</div>