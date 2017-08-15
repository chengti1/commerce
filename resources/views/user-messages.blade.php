@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Payment Methods</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Sender</th>
                            <th class="column-title">Message</th>
                            <th class="column-title">Reply</th>
                            <th class="column-title">Delete</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($messages as $message)
                            <tr>
                              <td>{{$message->first_name}}</td>
                              <td>{!!$message->message!!}</td>
                              <td><button onClick="location.href = '{{URL::asset('/')}}buyerdashboard/deletemessage?id={{$message->message_id}}';" type="button" class="btn btn-danger">reply</button></td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/deletemessage/{{$message->message_id}}';" type="button" class="btn btn-danger">delete</button></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
</div>

@stop