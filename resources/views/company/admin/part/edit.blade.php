@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        @include('company.admin.product.pedit')
    </div>
@stop

