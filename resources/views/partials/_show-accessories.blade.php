
<div class="row">
    <div class="box">
        <div class="box-body">
            <div class="col-xs-3">
                <a href="{{ route('show.accessory', $accessory->id) }}">{{ $accessory->name }}</a>
            </div>
            <div class="col-xs-2">
                {{ $accessory->year }}
            </div>
            <div class="col-xs-7">
                {{ $accessory->description }}
            </div>
        </div>
    </div>
</div>