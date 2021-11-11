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
                    <div class="form-group">
                        <label for="name">Skill Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <label id="name_error" class="error mt-2 text-danger d-none" for="name"></label>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" required>
                        <label id="icon_error" class="error mt-2 text-danger d-none" for="icon"></label>
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