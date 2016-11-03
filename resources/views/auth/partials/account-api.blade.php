<div class="tab-pane fade in" id="api">
    @if(count($keys) === 0)
        <div class="alert alert-info">
            There no api keys for this account.
            You can <a href="#" data-toggle="modal" data-target="#myModal">create</a> one here.
        </div>
    @else
        <a style="margin-bottom: 10px;" href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success btn-xs">New key</a>

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service:</th>
                    <th>Key:</th>
                    <th></th> {{-- Functions --}}
                </tr>
            </thead>
            <tbody>
                @foreach($keys as $key)
                    <tr>
                        <td><code>#K{{ $key->id }}</code></td>
                        <td>{{ $key->service }}</td>
                        <td><code>{{ $key->key }}</code></td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="{{ route('key.regenerate', ['id' => $key->id]) }}" data-toggle="tooltip" data-placement="bottom" title="Regenerate" class="btn btn-primary">
                                    <span class="fa fa-refresh"></span>
                                </a>
                                <a href="" data-toggle="tooltip" data-placement="bottom" title="Logs" class="btn btn-primary">
                                    <span class="fa fa-file-archive-o"></span>
                                </a>
                                <a href="" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-primary">
                                    <span class="fa fa-close"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Key create modal --}}
    @include('auth.partials.key-create')

        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

</div>