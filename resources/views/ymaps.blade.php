<div class="column is-7">
    <div id="myMap"></div>
</div>
{{--   LIST   --}}
<div class="column is-6">
    <div class="card events-card">
        <div class="card-header">
            <p class="card-header-title">
                Points
            </p>
            <a href="#" class="card-header-icon" aria-label="more options">
              <span class="icon">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </span>
            </a>
        </div>
        <div class="card-table">
            <div class="content">
                <table class="table is-fullwidth is-striped">
                    <tbody>
                    <tr>
                        <td>
                            <input id="namepos" class="input" type="text" placeholder="Place Name">
                        </td>
                        <td>
                            <input id="xpos" class="input" type="number" placeholder="X position">
                        </td>
                        <td>
                            <input id="ypos" class="input" type="number" placeholder="Y position">
                        </td>
                        <td class="level-right"><a id="addPoint" class="button is-small is-primary" href="#">ADD Point</a></td>
                    </tr>
                    @foreach($ymlist as $item)
                        <tr class="item-text" data-x="{{ $item["x"] }}" data-y="{{ $item["y"] }}">
                            <td>
                                <span>{{ $item["name"] }}</span>
                                <input class="input" type="text" value="{{ $item["name"] }}" placeholder="Place Name">
                            </td>
                            <td>
                                <span>{{ $item["x"] }}</span>
                                <input class="input" type="number" value="{{ $item["x"] }}" placeholder="X position">
                            </td>
                            <td>
                                <span>{{ $item["y"] }}</span>
                                <input id="ypos" class="input" type="number" value="{{ $item["y"] }}" placeholder="Y position">
                            </td>
                            <td class="level-right">
                                <a data-id="{{ $loop->index }}" class="button is-small is-primary _edit" href="#">Edit</a>
                                <a data-id="{{ $loop->index }}" class="button is-small is-cansel _delete" href="#">DEL</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- ENDLIST --}}
