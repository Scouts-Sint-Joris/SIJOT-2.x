<div class="tab-pane fade in" id="settings">
    <form method="POST" class="form-horizontal" action="{{ route('settings.profile.post') }}" enctype="multipart/form-data">
        {{-- CSRF TOKEN --}}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="theme" class="control-label col-md-2">
                Theme: <span class="text-danger">*</span>
            </label>

            <div class="col-sm-4 col-md-4">
                <select class="form-control" name="theme" id="theme">
                    <option value="">-- Select your theme --</option>

                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}" @if($user->theme === $theme->class) selected="selected" @endif>
                            {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="control-label col-sm-2">
                Naam: <span class="text-danger">*</span>
            </label>

            <div class="col-sm-4">
                <input type="text" id="name" class="form-control" placeholder="Gebruikersnaam" value="{{ $user->name}}" name="name" />
            </div>
        </div>


        <div class="form-group">
            <label for="email" class="control-label col-sm-2">
                Email: <span class="text-danger">*</span>
            </label>

            <div class="col-sm-4">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email adres." value="{{ $user->email }}" />
            </div>
        </div>

        <div class="form-group">
            <label for="avatar" class="control-label col-sm-2">
                Avatar: <!-- <span class="text-danger">*</span> -->
            </label>

            <div class="col-sm-4">
                <input type="file" name="avatar" id="avatar">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-sm btn-flat btn-success">Wijzigen.</button>
                <button type="reset" class="btn btn-danger btn-flat btn-sm">Reset</button>
            </div>
        </div>
    </form>
</div>