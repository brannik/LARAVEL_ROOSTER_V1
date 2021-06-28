@php
    use App\Http\Controllers\AdminAccData;
    use App\Http\Controllers\Settings; 
@endphp
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
<div class="container clearfix" id="settings_container">
    <div class="accordion py-3" id="accordionExample">
        @foreach(Settings::get_settings() as $option)
            <form action="/save_settings" method="get">
                <div class="accordion-item bg-secondary text-warning"> 
                    <h2 class="accordion-header bg-dark text-primary" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $option['opt_name'] }}" aria-expanded="true" aria-controls="{{ $option['opt_name'] }}">
                            {{ $option['description'] }}
                        </button>
                    </h2>
                    <div id="{{ $option['opt_name'] }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                @if($option['has_value'] == 1)
                                    <div class="col-2">
                                        Value: 
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="points_value" value="{{ $option['opt_value'] }}" style="width: 60px;">
                                    </div>
                                @endif
                                <div class="col-2">
                                    Allowed Rank
                                </div>
                                <div class="col-3">
                                    <select name="min_rank" class="form-select-sm">
                                        <option selected>{{ $option['min_rank'] }}</option>
                                        @foreach(AdminAccData::get_rank() as $wrank)
                                            @if(strcmp($option['min_rank'],$wrank['rank']) != 0)
                                                <option>{{ $wrank['rank'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                     and above
                                </div>
                                <div class="col-2">
                                    <input type="hidden" value="{{ $option['opt_id'] }}" name="option_id">
                                    <input type="hidden" value="{{ $option['opt_name'] }}" name="option">
                                    <button type="submit" class="btn btn-outline-warning btn-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
      
</div>

