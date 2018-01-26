
<div class="row">
    <div class="box">
        <div class="box-body">
            <div class="col-xs-3">
                <a href="{{ route('show.phone', $phone->id) }}">{{ $phone->name }}</a>
            </div>
            <div class="col-xs-2">
                {{ $phone->year }}
            </div>
            <div class="col-xs-7">
                {{ $phone->description }}
            </div>
        </div>
    </div>
</div>