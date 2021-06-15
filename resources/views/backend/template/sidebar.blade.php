@php
$types = App\Models\Type::where('type_id', null)->get();
foreach ($types as $list) {
$subtype = App\Models\Type::latest()->where('type_id', $list->id)->get();
foreach ($subtype as $li) {
$sstype = App\Models\Type::latest()->where('type_id', $li->id)->get();
$li->subtype = $sstype;
}
$list->subtype = $subtype;
}
@endphp
<!-- #Top Bar -->
<div>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar" style="background-color: #353c48;">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="sidebar-user-panel active">
                    <div class="user-panel">
                        <div class=" image">
                            <!-- <img src="{{ url('assets/images/user/usrbig6.jpg') }}" class="img-circle user-img-circle" alt="User Image" /> -->
                            <img src="{{ url('extraimage/images.jpg') }}" class="img-circle user-img-circle" alt="User Image" />
                        </div>
                    </div>
                    <div class="profile-usertitle">
                        <div class="sidebar-userpic-name"> admin </div>
                        <div class="profile-usertitle-job ">Manager </div>
                    </div>
                </li>
                <li class="active">
                    <a href="{{ route('admin-home') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users-list') }}">
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <!-- <i class="fas fa-angle-double-down"></i> -->
                        <i class="material-icons">folder</i>
                        <span>Master</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="#" onClick="return false;" class="menu-toggle">
                                <i class="fas fa-mail-bulk"></i>
                                <span>Age</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{ route('admin.age.create') }}">
                                        <span>Add</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.age.index') }}">
                                        <span>View</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onClick="return false;" class="menu-toggle">
                                <i class="fas fa-mail-bulk"></i>
                                <span>Cubic Capacity</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{ route('admin.cubiccapacity.create') }}">
                                        <span>Add</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.cubiccapacity.index') }}">
                                        <span>View</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onClick="return false;" class="menu-toggle">
                                <i class="fas fa-mail-bulk"></i>
                                <span>Type</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{ route('admin.type.create') }}">
                                        <span>Add</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.type.index') }}">
                                        <span>View</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="material-icons">shop</i>
                        <span>Idv</span>
                    </a>
                    <ul class="ml-menu">
                        @foreach($types as $type)
                        @if(count($type->subtype) == 0)
                        <li>
                            <a href="{{ route('admin.idv-list',$type->slug) }}">{{ $type->name }}</a>
                        </li>
                        @endif

                        @if(count($type->subtype) != 0)
                        <li>
                            <a href="#" onClick="return false;" class="menu-toggle">
                                <!-- <i class="fas fa-mail-bulk"></i> -->
                                <span>{{ $type->name }}</span>
                            </a>
                            <ul class="ml-menu">
                                @foreach($type->subtype as $subtype)
                                @if(count($subtype->subtype) == 0)
                                <li>
                                    <a href="{{ route('admin.idv-list',$subtype->slug) }}">{{ $subtype->name }}</a>
                                </li>
                                @endif

                                @if(count($subtype->subtype) != 0)
                                <li>
                                    <a href="#" onClick="return false;" class="menu-toggle">
                                        <!-- <i class="fas fa-mail-bulk"></i> -->
                                        <span>{{ $subtype->name }}</span>
                                    </a>
                                    <ul class="ml-menu">
                                        @foreach($subtype->subtype as $subtype)
                                        <li>
                                            <a href="{{ route('admin.idv-list',$subtype->slug) }}">
                                                <span>{{ $subtype->name }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="fas fa-sliders-h"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('admin.slider.create') }}">Add</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.slider.index') }}">View</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="fas fa-toolbox"></i>
                        <span>Tools</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('admin.tool.create') }}">Add</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tool.index') }}">View</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="material-icons">shop</i>
                        <span>Tp Rates</span>
                    </a>
                    <ul class="ml-menu">
                        @foreach($types as $type)
                        @if(count($type->subtype) == 0)
                        <li>
                            <a href="{{ route('admin.price-list',$type->slug) }}">{{ $type->name }}</a>
                        </li>
                        @endif

                        @if(count($type->subtype) != 0)
                        <li>
                            <a href="#" onClick="return false;" class="menu-toggle">
                                <!-- <i class="fas fa-mail-bulk"></i> -->
                                <span>{{ $type->name }}</span>
                            </a>
                            <ul class="ml-menu">
                                @foreach($type->subtype as $type)
                                @if(count($type->subtype) == 0)
                                <li>
                                    <a href="{{ route('admin.price-list',$type->slug) }}">{{ $type->name }}</a>
                                </li>
                                @endif

                                @if(count($type->subtype) != 0)
                                <li>
                                    <a href="#" onClick="return false;" class="menu-toggle">
                                        <!-- <i class="fas fa-mail-bulk"></i> -->
                                        <span>{{ $type->name }}</span>
                                    </a>
                                    <ul class="ml-menu">
                                        @foreach($type->subtype as $type)
                                        <li>
                                            <a href="{{ route('admin.price-list',$type->slug) }}">
                                                <span>{{ $type->name }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="material-icons">shop</i>
                        <span>Health</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="#" onClick="return false;" class="menu-toggle">
                                <!-- <i class="fas fa-mail-bulk"></i> -->
                                <span>Master</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{ route('admin.company.index') }}">
                                        <span>Company</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.healthzone.index') }}">
                                        <span>Zone</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.familysize.index') }}">
                                        <span>Family Size</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.healthage.index') }}">
                                        <span>Age</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.healthplan.index') }}">
                                        <span>Plan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.healthplanprice.index') }}">Plan Price</a>
                        </li>
                    </ul>
                </li>

                <!-- <li>
                        <a href="#" onClick="return false;" class="menu-toggle">
                            <i class="material-icons">folder</i>
                            <span>Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#" onClick="return false;" class="menu-toggle">
                                    <i class="fas fa-mail-bulk"></i>
                                    <span>About Us</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="#">
                                            <span>Add</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>View</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onClick="return false;" class="menu-toggle">
                                    <i class="fas fa-mail-bulk"></i>
                                    <span>Faq</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="#">
                                            <span>Add</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>View</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onClick="return false;" class="menu-toggle">
                                    <i class="fas fa-mail-bulk"></i>
                                    <span>Service</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="#">
                                            <span>Add</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>View</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" onClick="return false;" class="menu-toggle">
                                    <i class="fas fa-mail-bulk"></i>
                                    <span>Term & Condition</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="#">
                                            <span>Add</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>View</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation">
                <a href="#skins" data-toggle="tab" class="active">SKINS</a>
            </li>
            <li role="presentation">
                <a href="#settings" data-toggle="tab">SETTINGS</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active in active stretchLeft" id="skins">
                <div class="demo-skin">
                    <div class="rightSetting">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list list-unstyled m-t-20">
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> Save
                                            History
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> Show
                                            Status
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> Auto
                                            Submit Issue
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> Show
                                            Status To All
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="rightSetting">
                        <p>SIDEBAR MENU COLORS</p>
                        <button type="button" class="btn btn-sidebar-light btn-border-radius p-l-20 p-r-20">Light</button>
                        <button type="button" class="btn btn-sidebar-dark btn-default btn-border-radius p-l-20 p-r-20">Dark</button>
                    </div>
                    <div class="rightSetting">
                        <p>THEME COLORS</p>
                        <button type="button" class="btn btn-theme-light btn-border-radius p-l-20 p-r-20">Light</button>
                        <button type="button" class="btn btn-theme-dark btn-default btn-border-radius p-l-20 p-r-20">Dark</button>
                    </div>
                    <div class="rightSetting">
                        <p>SKINS</p>
                        <ul class="demo-choose-skin choose-theme list-unstyled">
                            <li data-theme="black" class="actived">
                                <div class="black-theme"></div>
                            </li>
                            <li data-theme="white">
                                <div class="white-theme white-theme-border"></div>
                            </li>
                            <li data-theme="purple">
                                <div class="purple-theme"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue-theme"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan-theme"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green-theme"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange-theme"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="rightSetting">
                        <p>Disk Space</p>
                        <div class="sidebar-progress">
                            <div class="progress m-t-20">
                                <div class="progress-bar l-bg-cyan shadow-style width-per-45" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-description">
                                <small>26% remaining</small>
                            </span>
                        </div>
                    </div>
                    <div class="rightSetting">
                        <p>Server Load</p>
                        <div class="sidebar-progress">
                            <div class="progress m-t-20">
                                <div class="progress-bar l-bg-orange shadow-style width-per-63" role="progressbar" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-description">
                                <small>Highly Loaded</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane stretchRight" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-green"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever switch-col-blue"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-purple"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-cyan"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-red"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever switch-col-lime"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</div>