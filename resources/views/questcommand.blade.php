@extends('layouts.main')

@section('title','任務指令')

@section('dialog')
@endsection

@section('content')
	@if(!Auth::Guest())
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>
            $(document).ready(function(){

                  $('.user').hover(
                        function(){
                              $(this).css("border","1px solid #3c76e7");
                        },
                        function(){
                              $(this).css("border","none");
                        });

            });

      </script>

      <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                  <div class="panel-heading">
                        <h4 class="text-center">{{ $quest->name }}</h4>
                        <div class="text-right">
                              協作者：
                              @foreach($workers as $worker)
                                    <img class="img img-rounded user" style="width:30px;height:30px" src="{{asset('personal_img/'.$worker->picture_path)}}"></img>
                              @endforeach
                        </div>
                  </div>
                  <div class="panel-body">
                        <div class="row">
                              <div class="col-md-2">
                                    <img class="center-block" style="max-width:100px" src="{{asset('personal_img/'.Auth::user()->picture_path)}}"></img>
                              </div>
                              <form class="form" method="POST" action="/questcommand/{{$quest->id}}">
                              {{csrf_field()}}
                                    <div class="col-md-8 form-group">
                                          <textarea name="command_text" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="col-md-2 form-group">
                                          <button type="submit" style="position:relative;top:30px" class="btn btn-lg btn-primary">POST</button>
                                    </div>
                              </form>
                        </div><!--ROW-->
                        
                        <div class="row">
                              <table class="table">
                              @if(count($commands) == 0)
                              There are no commands now...
                              @else
                              @foreach($commands as $command)
                              <tr @if($command->author_identity == 1) class="info" @endif>
                                    <td class="col-md-2"><img style="max-width:100px" src="{{asset('personal_img/'.$command->picture_path)}}"></img></td>
                                    <td>
                                          <i style="color:grey;position:absolute;right:3%" class="icon-pencil">
                                                <small> posted at {{ $command->created_at }}</small>
                                          </i>
                                          <h4>{{ $command->name }}</h4>{{ $command->context }}
                                    </td>
                              </tr>
                              @endforeach
                              @endif
                              </table>
                        </div><!--ROW-->
                  </div>
                  @if(Auth::user()->auth == 1)
                  <div class="panel-footer">
                        <a class="col-md-offset-2 btn btn-lg btn-success">宣布任務完成</a>
                        <a class="col-md-offset-3 btn btn-lg btn-danger">宣布任務失敗</a>
                  </div>
                  @endif
            </div>
      </div>

	@endif
@endsection