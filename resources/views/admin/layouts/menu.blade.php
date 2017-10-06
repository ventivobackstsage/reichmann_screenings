@if (Sentinel::check() && (Sentinel::inRole('admin')||Sentinel::inRole('company')))
<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('admin.orders.index') !!}">
        <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
           data-loop="true"></i>
        Orders
    </a>
</li>
@endif
@if (Sentinel::check() && Sentinel::inRole('admin'))
<li class="{{ Request::is('companies*') ? 'active' : '' }}">
    <a href="{!! route('admin.companies.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
               data-loop="true"></i>
               Companies
    </a>
</li>
@endif
@if (Sentinel::check() && (Sentinel::inRole('admin')||Sentinel::inRole('company')))
<li class="{{ Request::is('candidates*') ? 'active' : '' }}">
    <a href="{!! route('admin.candidates.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
               data-loop="true"></i>
               Candidates
    </a>
</li>
@endif
@if (Sentinel::check() && (Sentinel::inRole('candidate')))
<li class="{{ Request::is('resume*') ? 'active' : '' }}">
    <a href="{!! route('admin.resume.index') !!}">
        <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
           data-loop="true"></i>
        Resume
    </a>
</li>
@endif
@if (Sentinel::check() && (Sentinel::inRole('candidate')))
<li class="{{ Request::is('education*') ? 'active' : '' }}">
    <a href="{!! route('admin.education.index') !!}">
        <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
           data-loop="true"></i>
        Education
    </a>
</li>
@endif
@if (Sentinel::check() && (Sentinel::inRole('candidate')))
<li class="{{ Request::is('certificates*') ? 'active' : '' }}">
    <a href="{!! route('admin.certificates.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
               data-loop="true"></i>
               Certificates
    </a>
</li>
@endif
@if (Sentinel::check() && (Sentinel::inRole('candidate')))
<li class="{{ Request::is('experiences*') ? 'active' : '' }}">
    <a href="{!! route('admin.experiences.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="$ICON_NAME$" data-size="18"
               data-loop="true"></i>
               Experiences
    </a>
</li>
@endif
@if (Sentinel::check() && Sentinel::inRole('company'))
<li {!! ((Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/user_profile') || Request::is('admin/users/*') || Request::is('admin/deleted_users')) ? 'class="active"' : '') !!}>
<a href="#">
    <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
       data-loop="true"></i>
    <span class="title">Colleagues</span>
    <span class="fa arrow"></span>
</a>
<ul class="sub-menu">
    <li {!! (Request::is('admin/users') ? 'class="active" id="active"' : '') !!}>
    <a href="{{ URL::to('admin/users') }}">
        <i class="fa fa-angle-double-right"></i>
        List Colleagues
    </a>
    </li>
    <li {!! (Request::is('admin/users/invite') ? 'class="active" id="active"' : '') !!}>
    <a href="{{ URL::to('admin/users/invite') }}">
        <i class="fa fa-angle-double-right"></i>
        Invite
    </a>
    </li>
</ul>
</li>
@endif
