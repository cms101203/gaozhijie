@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">添加项目</h3>
                        </div>
                        <div class="panel-body">
                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="/admin/xm">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="cove_image"/>
                                @include('admin.xm._form')
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <button type="submit" class="btn btn-primary  btn-lg pull-right">
                                            <i class="fa fa-plus-circle"></i>
                                            添加
                                        </button>
                                        <a  class="btn btn-default" href="/admin/xm"><i class="fa fa-angle-double-left"></i> Back</a>
                                    </div>
                                </div>

                            </form>
                            @include('admin.layouts.upload_img')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop