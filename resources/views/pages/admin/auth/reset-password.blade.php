<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.auth.reset-password') }}" method="post" id="form">
                @csrf
                <div class="modal-body">
                    <div id="resetPasswordErr"></div>
                    <div class="form-group">
                        <label>Current password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="current_password" placeholder="">
                        <span class="text-danger current-password-err"></span>
                    </div>
                    <div class="form-group">
                        <label>New password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="new_password" placeholder="">
                        <span class="text-danger new-password-err"></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="">
                        <span class="text-danger confirm-password-err"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="resetPassword()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#resetPassBtn').click(function () {
        $('#form')[0].reset();
        resetMessageErr();
    });

    function resetPassword() {
        $.ajax({
            type: "POST",
            url: $('#form').attr('action'),
            data: $('#form').serialize(),
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data.status === 200) {
                $('#resetPasswordModal').modal('hide');
                alert(data.message);
                window.location.replace('{{ url('admin/logout') }}');
            } else if (data.status === 422) {
                resetMessageErr();

                let blockErr = '<div class="alert alert-danger alert-block">' +
                                    '<strong>'+ data.message +'</strong>' +
                            '</div>';

                $('#resetPasswordErr').html(blockErr);
            }
        }).fail(function (data) {
            let errors = data.responseJSON.errors;

            $('.current-password-err').html(errors.current_password ?? '');
            $('.new-password-err').html(errors.new_password ?? '');
            $('.confirm-password-err').html(errors.confirm_password ?? '');
        });

        event.preventDefault();
    }

    function resetMessageErr() {
        $('.current-password-err').html('');
        $('.new-password-err').html('');
        $('.confirm-password-err').html('');
        $('#resetPasswordErr').html('');
    }
</script>
