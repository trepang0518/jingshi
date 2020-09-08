@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新成员信息</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.team.update',['id'=>$teams->id])}}" method="post">
                {{ method_field('put') }}
                @include('admin.team._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.team._js')
@endsection
