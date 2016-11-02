<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new API key.</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('settings.profile.key') }}" method="POST" class="form-horizontal">
                    {{-- CSRF field --}}
                    {{ csrf_field() }}

                    {{-- user id --}}
                    <input type="hidden" name="userid" value="{{ $user->id }}">

                    {{-- Service name --}}
                    <div class="form-group">
                        <label class="control-label col-sm-2">
                            Service: <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" name="service" id="service" placeholder="service name">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Create</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>