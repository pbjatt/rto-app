<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Idv Rate List</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-home') }}">
                                <i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Idv Rate List</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="pt-2"><b>Idv Rate List</b></h2>
                        <h2 class="header-dropdown m-r--5"><a href="{{ url('/admin/idv/create/?category='.$category) }}" class="btn btn-primary" style="padding-top: 8px;">Add Idv Rate</a></h2>
                    </div>
                    <div class="body">
                        @if(!empty($idv_rates))
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example contact_list">
                                <thead>
                                    <td rowspan="2" class="text-center" style="border: 1px solid;">Age</td>
                                    @foreach($zone as $z)
                                    <td colspan="{{ count($all_cc) }}" class="text-center" style="border: 1px solid;">Zone {{ $z }}</td>
                                    @endforeach
                                    @if(count($all_cc) != 0)
                                    <tr>
                                        @foreach($zone as $z)
                                        <td colspan="{{ count($all_cc) }}" class="text-center" style="border: 1px solid;">Cubic Capacity</td>
                                        @endforeach
                                    <tr>
                                        @endif
                                    <tr>
                                        @foreach($zone as $z)
                                        @foreach($all_cc as $cc)
                                        <td style="border: 1px solid;">{{ $cc }}</td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                    @foreach($idv_rates as $age => $age_data)
                                    <tr>
                                        <td style="border: 1px solid;">{{ $age }}</td>
                                        @foreach($age_data as $zone_data => $idv)
                                        <td style="border: 1px solid;">
                                            @if(!empty($idv->id))
                                            <a href="{{ route('admin.idv.edit',$idv->id) }}" title="edit"><i class="material-icons" style="font-size: 15px; color: black;">mode_edit</i> {{ $idv->idv }} % on IDV</a>
                                            {{ Form::open(array('url' => route('admin.idv.destroy',$idv->id), 'class' => 'btn tblActnBtn')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button class="btn tblActnBtn" title="dalete">
                                                <a style="color: black;"><i class="material-icons" style="font-size: 15px;">delete</i></a>
                                            </button>
                                            {{ Form::close() }}
                                            @endif
                                            @if(empty($idv->id))
                                            Null
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if(empty($idv_rates))
                        No Records Found.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>