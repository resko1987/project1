<div class="mt-1">
    <form class="user_settings"> 
        <?
        /*
          <div class="form-group row mb-6">
          <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
          <div class="col-sm-8 col-lg-10">
          <div class="custom-file mb-1">
          <input type="file" class="custom-file-input" id="coverImage" required>
          <label class="custom-file-label" for="coverImage">Choose file...</label>
          <div class="invalid-feedback">Example invalid custom file feedback</div>
          </div>
          </div>
          </div>
         */
        ?>
        <div class="row mb-2">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" name="first_name" class="form-control first_name" id="first_name" value="" required>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" name="last_name" class="form-control last_name" id="last_name" value="" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="user_phone">Телефон</label>
            <input type="text" name="user_phone" class="form-control user_phone" id="user_phone" value="" required>
            <span class="d-block mt-1">Телефон для оповещений и восстановления аккаунта.</span>
        </div>

        <div class="form-group mb-4">
            <label for="user_email">Email</label>
            <input type="email" name="user_email" class="form-control user_email" id="user_email" value="" required>
        </div>

        <div class="form-group mb-4">
            <label for="oldPassword">Old password</label>
            <input type="password" name="oldPassword" class="form-control oldPassword" id="oldPassword">
        </div>

        <div class="form-group mb-4">
            <label for="newPassword">New password</label>
            <input type="password" name="newPassword" class="form-control newPassword" id="newPassword">
        </div>

        <div class="form-group mb-4">
            <label for="conPassword">Confirm password</label>
            <input type="password" name="conPassword" class="form-control conPassword" id="conPassword">
        </div>
        <div class="form_result" style="display: none;">

        </div>

    </form>
</div>
<script>
    $(function () {



    });
</script> 