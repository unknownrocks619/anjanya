@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $programUser = new \App\Models\Portal\ProgramUser();
    $userModelQuery = \App\Models\Portal\UserModel::query();
    $query = $query ?? [];
    if( ! isset ($query['page']) ) {
        $query['page'] = 1;
    }
    $page = $query['page'];
    $filter = $query;
    unset($filter['page']);

    $userModelQuery
        ->join($programUser->getTable(), function (Illuminate\Database\Query\JoinClause $join) use (
            $programUser,
            $event,
        ) {
            $join->on('student_id', 'members.id');
            $join->where('program_id', $event['portal_program_id']);
        })
        ->selectRaw('members.* , ' . $programUser->getTable() . '.created_at AS user_registration_date')
        ->with(['diskshya', 'meta', 'emergency', 'profileImage']);
    
    if (isset($filter['filter_term'])){
            $term = '%'. strip_tags(trim($filter['filter_term'])) . '%';

            $userModelQuery->where(function($query) use ($term, $programUser){
                $query->where('first_name','LIKE',$term)
                            ->orWhere('full_name','LIKE', $term)
                            ->orWhere('last_name', 'LIKE',$term)
                            ->orWhere('email','LIKE',$term)
                            ->orWhere('phone_number','LIKE',$term)
                            ->orWhere('city','LIKE',$term)
                            ->orWhere($programUser->getTable().'.created_at' ,'LIKE', $term);
            });
        }
        if (isset($filter['filter_date']) ) {
            $date = strtolower($filter['filter_date']);
            $explodeDate = explode('to', $date);
            $startDate = trim ($explodeDate[0]);
            $endDate  = trim ($explodeDate[1] ?? '');

            $userModelQuery->where(function ($query) use ( $programUser, $startDate, $endDate) {
                $query->whereRaw("DATE(".$programUser->getTable() . ".created_at) >= ? ", [$startDate]);
                if ($endDate) {
                    $query->whereRaw("DATE(".$programUser->getTable() . ".created_at) <= ? ", [$endDate]);
                }
            });
        }

        if (isset($filter['filter_country']) ) {
            $filterCountry = (int) $filter['filter_country'];
            if ($filterCountry) {
                $userModelQuery->where('country', '=', $filterCountry);

            }
        }


    $totalRecord = $userModelQuery->toBase()->getCountForPagination();
    $usersForCurrentPage = $userModelQuery->forPage($page,60)->get();

    $users = new \Illuminate\Pagination\LengthAwarePaginator(
        $usersForCurrentPage,
        $totalRecord,
        60,
        $page,
        [
        'path'  => route('admin.events.edit',array_merge(['tab' => 'user-registrations','event' => $event['id']], $filter))
        ]);
@endphp
<div class="row my-2 align-items-center">

        <div class="col-md-10">
            <div class="row">

                <div class="col-md-3">
                    <input type="text" name="filter_term" placeholder="Search By" id="filterSearchTerm" class="form-control" />
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <select onchange="applyChangeEffect()" name="filter_country" id="filter_country" class="form-control">
                            <option value="" selected>Filter By Country</option>
                            @foreach (App\Models\Country::get() as $country)
                                <option @if($country->getKey() == ($filter['filter_country'] ?? 0))  selected @endif value="{{$country->getKey()}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" onchange="applyChangeEffect()" name="filter_date" class="form-control" placeholder="YYYY-MM-DD TO YYYY-MM-DD"
                                pattern="\d{4}-\d{2}-\d{2} TO \d{4}-\d{2}-\d{2}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-info btn-icon" type='button' onclick="downloadFile()">
                        <i class="fa fa-file-excel-o fs-5"></i>
                    </button>
                    <button class="btn btn-primary">Apply Filter</button>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="d-flex flex-wrap justify-content-end">
                <a href="{{ route('admin.events.registration', ['event' => $event['id'], 'type' => 'old-registration']) }}"
                    class="btn btn-danger btn-sm px-3 mb-1">
                    <i class="fa fa-plus"></i> New Registration
                </a>
                <a href="{{ route('admin.events.registration', ['event' => $event['id'], 'type' => 'registration']) }}"
                    class="btn btn-primary btn-sm px-3">
                    <i class="fa fa-plus"></i> Old Registration
                </a>
            </div>
        </div>
</div>

<div class="row my-2 border-2">
    <div class="col-md-12 bg-white py-2">
        <h2 class="text-dark">Registration List</h2>
    </div>
    <div class="col-12">
        <div class="row registration_user_detail">
            @include('Events::backend.events.tabs.partials.users',['users' => $users])
        </div>
    </div>
</div>

<script>
    var _request = null;
        $(()=>{
            // applyChangeEffect();
        })
        document.getElementById('filterSearchTerm').addEventListener('input', function () {
        let _inputValue = this.value;

        if (_request) {
            _request.abort();
        }
        let _filterDate  = $("input[name='filter_date']").val() 
        let _filterCountry = $("select[name='filter_country']").find(':selected').val()

        let _data = {
            filter_term: _inputValue,
            filter_country : _filterCountry,
            filter_date : _filterDate 
        }
        if (_request) {
            console.log('shoudl be aborted.');
            _request.abort();
        }
        _request = $.ajax({
            type: 'get',
            url : '{{route("admin.event.search",["event" => $event["id"]])}}',
            data : _data,
            success: function (response) {
                console.log('respnose:',response);
                $('.registration_user_detail').html(response);
            }
        })

    })
    

    function applyChangeEffect() {

        if (_request) {
            _request.abort();
        }

        let _filterCountry = $("select[name='filter_country']").find(':selected').val()
        let _filterDate  = $("input[name='filter_date']").val() 
        let _filterTerm  = $("input[name='filter_name']").val() 

        let _data = {
            filter_term: _filterTerm,
            filter_country : _filterCountry,
            filter_date : _filterDate 
        }

        _request = $.ajax({
            type: 'get',
            url : '{{route("admin.event.search",["event" => $event["id"]])}}',
            data : _data,
            success: function (response) {

                $('.registration_user_detail').html(response);
            }
        })
    }

    function downloadFile() {
        let _filterCountry = $("select[name='filter_country']").find(':selected').val()
        let _filterDate  = $("input[name='filter_date']").val() 
        let _filterTerm  = $("input[name='filter_name']").val() 


        let _data = {
            filter_term: _filterTerm,
            filter_country : _filterCountry,
            filter_date : _filterDate 
        }

        window.open('{{route("admin.event.download",["event" => $event['id']])}}?'+$.param(_data),'_blank')
    }

</script>
