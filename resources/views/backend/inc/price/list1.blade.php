<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Price List</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-home') }}">
                                <i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Price List</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="pt-2"><b>Price List</b></h2>
                        <h2 class="header-dropdown m-r--5"><a href="{{ url('/admin/price/create/?category='.$category) }}" class="btn btn-primary" style="padding-top: 8px;">Add Price</a></h2>
                    </div>
                    <div class="body">
                        @if(!empty($price_rates))
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example contact_list">
                                <thead>
                                    <td rowspan="2" class="text-center" style="border: 1px solid;">Cubic Capacity</td>
                                    <!-- @foreach($zone as $z)
                                    <td colspan="{{ count($all_cc) }}" class="text-center" style="border: 1px solid;">Zone {{ $z }}</td>
                                    @endforeach -->
                                    <tr>
                                        <td style="border: 1px solid;">Basic TP</td>
                                        <td style="border: 1px solid;">Per Pessanger</td>
                                    </tr>
                                    @foreach($price_rates as $cc => $price)
                                    <tr>
                                        <td style="border: 1px solid;">{{ $cc }}</td>
                                        <td style="border: 1px solid;">
                                            @if(!empty($price->id))
                                            <a href="{{ route('admin.price.edit',$price->id) }}" title="edit"><i class="material-icons" style="font-size: 15px; color: black;">mode_edit</i> {{ $price->price }}/- ₹</a>
                                            {{ Form::open(array('url' => route('admin.price.destroy',$price->id), 'class' => 'btn tblActnBtn')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button class="btn tblActnBtn" title="dalete">
                                                <a style="color: black;"><i class="material-icons" style="font-size: 15px;">delete</i></a>
                                            </button>
                                            {{ Form::close() }}
                                            @endif
                                            @if(empty($price->id))
                                            Null
                                            @endif
                                        </td>
                                        <td style="border: 1px solid;">{{ $price->per_pessanger }}/- ₹</td>
                                    </tr>
                                    @endforeach
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if(empty($price_rates))
                        No Records Found.
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>