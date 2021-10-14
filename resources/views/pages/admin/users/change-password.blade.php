<div class="modal" tabindex="-1" role="dialog" id="changePasswordModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="formChangePassword">
                @csrf
                <div class="modal-body">
                    <div id="changePasswordErr"></div>
                    <div class="form-group">
                        <label>New password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="new_password" placeholder="6-16 characters">
                        <span class="text-danger new-password-err" id=""></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="6-16 characters">
                        <span class="text-danger confirm-password-err" id=""></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="changePassword()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function openChangePasswordModal(id) {
        $('#formChangePassword')[0].reset();
        resetMessageErr();
        $('#changePasswordModal').modal();
        let url = '{{ url('admin/users/change-password') }}' + '/' + id;
        $('#formChangePassword')[0].setAttribute('action', url);
    }

    function changePassword() {
        $.ajax({
            type: "POST",
            url: $('#formChangePassword').attr('action'),
            data: $('#formChangePassword').serialize(),
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data.status === 200) {
                $('#changePasswordModal').modal('hide');
            } else if (data.status === 422) {
                resetMessageErr();

                let blockErr = '<div class="alert alert-danger alert-block">' +
                                    '<strong>'+ data.message +'</strong>' +
                                '</div>';

                $('#changePasswordErr').html(blockErr);
            }
        }).fail(function (data) {
            let errors = data.responseJSON.errors;

            $('.new-password-err').html(errors.new_password ?? '');
            $('.confirm-password-err').html(errors.confirm_password ?? '');
        });

        event.preventDefault();
    }

    function resetMessageErr() {
        $('.new-password-err').html('');
        $('.confirm-password-err').html('');
        $('#changePasswordErr').html('');
    }
</script>
