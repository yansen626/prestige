<div id="acceptModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Accept Bank Transfer</h2>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Are you sure ?</h3>
                <br />

                <form role="form">
                    <input type="hidden" id="accept-id" name="accept-id"/>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> No
                    </button>
                    <button type="submit" class="btn btn-danger accept">
                        <span class='glyphicon glyphicon-trash'></span> Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>