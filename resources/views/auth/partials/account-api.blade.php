<div class="tab-pane fade in" id="api">
    @if(count($keys) === 0)
        <div class="alert alert-info">
            There no api keys for this account.
            You can <a href="#" data-toggle="modal" data-target="#myModal">create</a> one here.
        </div>
    @else
    @endif

    {{-- Key create modal --}}
    @include('auth.partials.key-create')
</div>