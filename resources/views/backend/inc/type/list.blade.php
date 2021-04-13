<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Type List</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-home') }}">
                                <i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Type List</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="pt-2"><b>Type List</b></h2>
                        <h2 class="header-dropdown m-r--5"><a href="{{ route('admin.type.create') }}" class="btn btn-primary" style="padding-top: 8px;">Add Type</a></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example contact_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Sub Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sn = 1;
                                    @endphp
                                    @foreach($lists as $list)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td></td>
                                        <td>
                                            <button class="btn tblActnBtn">
                                                <a href="{{ route('admin.type.edit',$list->id) }}" style="color: black;"><i class="material-icons">mode_edit</i></a>
                                            </button>
                                            {{ Form::open(array('url' => route('admin.type.destroy',$list->id), 'class' => 'btn tblActnBtn')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            @if(count($list->subtype) != 0)
                                            <button class="btn tblActnBtn" disabled>
                                                <a style="color: black;"><i class="material-icons">delete</i></a>
                                            </button>
                                            @endif
                                            @if(count($list->subtype) == 0)
                                            <button class="btn tblActnBtn">
                                                <a style="color: black;"><i class="material-icons">delete</i></a>
                                            </button>
                                            @endif
                                            {{ Form::close() }}
                                        </td>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach($list->subtype as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <button class="btn tblActnBtn">
                                                <a href="{{ route('admin.type.edit',$item->id) }}" style="color: black;"><i class="material-icons">mode_edit</i></a>
                                            </button>
                                            {{ Form::open(array('url' => route('admin.type.destroy',$list->id), 'class' => 'btn tblActnBtn')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button class="btn tblActnBtn">
                                                <a style="color: black;"><i class="material-icons">delete</i></a>
                                            </button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>