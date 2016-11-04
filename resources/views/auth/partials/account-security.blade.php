<div class="tab-pane fade in" id="security">
    <form action="" method="POST" class="form-horizontal">
        {{-- CSRF TOKEN --}}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="password" class="control-label col-sm-3">
                Password: <span class="text-danger">*</span>
            </label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="password" name="assword" placeholder="Wachtwoord">
            </div>
        </div>

        <div class="form-group">
            <label for="confirm" class="control-label col-sm-3">
                Confirm password: <span class="text-danger">*</span>
            </label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="confirm" name="password_confirmation" placeholder="Wachtwoord bevestiging">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
                <button type="submit" class="btn btn-sm btn-flat btn-success">Wijzigen.</button>
                <button type="reset" class="btn btn-danger btn-flat btn-sm">Reset</button>
            </div>
        </div>
    </form>
</div>