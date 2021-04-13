<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Health Price List</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-home') }}">
                                <i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Health Price List</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="pt-2"><b>Health Price List</b></h2>
                        <h2 class="header-dropdown m-r--5"><a href="{{ route('admin.healthplanprice.create') }}" class="btn btn-primary" style="padding-top: 8px;">Add Health Price</a></h2>
                    </div>
                    <div class="body">
                        {{ Form::open(['url' => route('admin.healthplanprice.index'), 'method'=>'GET', 'files' => true, 'id' => 'planpriceChange']) }}
                        <div class="form-group" style="width: 30%; margin: auto;">
                            {{ Form::select('company', $companyArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required','onchange' => 'submitForm()']) }}
                        </div>
                        {{ Form::close() }}
                        <hr>
                        @if(!empty($health_prices))
                        <div class="table-responsive">
                            @foreach($health_prices as $ht => $healthzone)
                            <table class="table table-hover js-basic-example contact_list" style="margin-bottom: 30px;">
                                <tr>
                                    <td colspan="4" class="text-center" style="border: 1px solid;">{{ $ht }}</td>
                                </tr>
                                <tr>
                                    <th rowspan="2" class="text-center" style="border: 1px solid;">Family Size</th>
                                    <th rowspan="2" class="text-center" style="border: 1px solid;">Age-band in years</th>
                                    <td colspan="4" class="text-center" style="border: 1px solid;">Sum Insured in Rs.</td>
                                </tr>
                                <tr>
                                    @foreach($plans as $cc)
                                    <th class="text-center" style="border: 1px solid;">{{ $cc }}</th>
                                    @endforeach
                                </tr>
                                @foreach($healthzone as $age => $age_data)
                                <tr>
                                    <td rowspan="{{ count($age_data) + 1 }}" style="border: 1px solid; margin:auto; text-align:center;">{{ $age }}</td>
                                    @foreach($age_data as $zone => $zone_data)
                                <tr>
                                    <td style="border: 1px solid;">{{ $zone }}</td>
                                    @foreach($zone_data as $price)
                                    <td style="border: 1px solid;">
                                        @if(!empty($price->id))
                                        <a href="{{ route('admin.healthplanprice.edit',$price->id) }}" title="edit"><i class="material-icons" style="font-size: 15px; color: black;">mode_edit</i> {{ $price->price }}</a>
                                        {{ Form::open(array('url' => route('admin.healthplanprice.destroy',$price->id), 'class' => 'btn tblActnBtn')) }}
                                        @endif
                                        @if(empty($price->id))
                                        Null
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                </tr>
                                @endforeach
                            </table>
                            @endforeach
                        </div>
                        @endif
                        @if(empty($health_prices))
                        No Records Found.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function submitForm() {
        document.getElementById('planpriceChange').submit();
    }
</script>