@extends('admin.dashboard')

@section('content')
<div class='row'>
  <div class="col-md-12">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Top used</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Used</td>
                            <td>ID</td>
                            <td>Email</td>
                            <td>Last Date</td>
                        </tr>
                        @foreach ($top_used as $flows)
                        <tr>
                            <td>{{ number_format($flows->used/MB, 2) }}MB</td>
                            <td>{{ $flows->user->id }}</td>
                            @if (mb_strlen($flows->user->email) > 19)
                            <td>{{ mb_substr(mb_split('@', $flows->user->email)[0], 0, 19) }}</td>
                            @else
                            <td>{{ $flows->user->email }}</td>
                            @endif
                            <td>{{ mb_substr($flows->updated_at ,5) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Overview</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>DAU</td>
                            <td>{{ $dau }}</td>
                        </tr>
                        <tr>
                            <td>PaidDAU</td>
                            <td>{{ $paid_dau }}</td>
                        </tr>
                        <tr>
                            <td>Revenue</td>
                            <td>￥ {{ $revenue }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer no-padding" style="display: block;">
            </div>
            <!-- /.footer -->
        </div>
    </div>

  </div>
</div><!-- /.row -->
@endsection
