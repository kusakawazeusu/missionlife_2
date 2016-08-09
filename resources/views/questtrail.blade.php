@extends('layouts.main')

@section('title','管理任務')

@section('dialog')
@endsection

@section('content')
	@if(!Auth::Guest() && Auth::user()->auth=='1' && Auth::user()->name == $quests[0]->creator)
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>
            $(document).ready(function(){

                  $('.user').hover(
                        function()
                        {
                              $(this).css("border","2px solid #3c76e7");
                              $(this).parent().find('.namae').fadeIn(100);
                        },
                        function()
                        {
                              $(this).parent().find('.namae').fadeOut(100,function(){
                                    $(this).parent().find('.user').css("border","none");
                              }); 
                        }
                  );

                  $('.user').click(function(){
                        $('#users_'+ $(this).attr("name") ).modal('show');
                  });
            });

      </script>

      @for($i=0;$i<count($quests);$i++)
      <div class="modal fade" id="users_{{$quests[$i]->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">申請人資料 - {{ $quests[$i]->user_name }}</h4>
                        </div>
                        <div class="modal-body">
                              <div class="col-md-12">
                                    <img src="{{asset('personal_img/'.$quests[$i]->picture_path)}}" class="img-rounded img-responsive center-block" alt="personal_image" style="max-height:150px;">
                                    <br>
                                    <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#before">基本資料</a></li>
                                          <li><a data-toggle="tab" href="#now">技能列表</a></li>
                                          <li><a data-toggle="tab" href="#finished">近期完成的任務</a></li>
                                    </ul>
                                    
                              </div>
                              <div class="col-md-12">
                                    <table class="table">
                                          <tr>
                                                <td>姓名</td>
                                                <td>{{ $quests[$i]->user_name }}</td>
                                          </tr>
                                          <tr>
                                                <td>性別</td>
                                                <td>@if($quests[$i]->gender==1)男 @else 女 @endif</td>
                                          </tr>
                                          <tr>
                                                <td>E-Mail</td>
                                                <td>{{ $quests[$i]->email }}</td>
                                          </tr>
                                          <tr>
                                                <td>系所</td>
                                                <td>{{ $quests[$i]->user_department }}</td>
                                          </tr>
                                          <tr>
                                                <td>聲望</td>
                                                <td>{{ $quests[$i]->fame }}</td>
                                          </tr>
                                    </table>
                              </div>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                              @if($quests[$i]->status == 0)
                              <a href="/questmanage/{{ $quests[$i]->quest_id }}/{{ $quests[$i]->user_id }}" class="btn btn-primary">指派任務</a>
                              @elseif($quests[$i]->status == 1)
                              <a class="btn btn-primary disabled">已指派任務給該冒險者</a>
                              @endif
                        </div>
                  </div>
            </div>
      </div>
      @endfor


      <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                  <div class="panel-heading"><h4 class="text-center">{{ $quests[0]->name }}</h4></div>
                  <div class="panel-body">
                        <table class="table">
                              <tr>
                                    <td class="col-md-2">任務名稱</td>
                                    <td class="col-md-6">{{ $quests[0]->name }}</td>
                              </tr>
                              <tr>
                                    <td>開始日期</td>
                                    <td>{{ $quests[0]->start_at }}</td>
                              </tr>
                              <tr>
                                    <td>結束日期</td>
                                    <td>{{ $quests[0]->end_at }}</td>
                              </tr>
                              <tr>
                                    <td>任務敘述</td>
                                    <td>{{ $quests[0]->description }}</td>
                              </tr>
                              <tr>
                                    <td>任務薪資</td>
                                    <td>{{ $quests[0]->salary }}</td>
                              </tr>
                              <tr>
                                    <td>獎勵點數</td>
                                    <td>{{ $quests[0]->point }}</td>
                              </tr>
                              <tr>
                                    <td>需求人數</td>
                                    <td>{{ $quests[0]->workforce }}</td>
                              </tr>
                              <tr>
                                    <td>申請者</td>
                                    <td>
                                          @for($i=0;$i<count($quests);$i++)
                                          @if($quests[$i]->status == 0)
                                                <div tyle="margin-right:10px" class="col-md-1">
                                                      <img class="img user" name="{{$quests[$i]->user_id}}" style="border-top-left-radius:4px;border-top-right-radius:4px;width:50px;height:50px" src="{{asset('personal_img/'.$quests[$i]->picture_path)}}"></img>
                                                      <div class="namae" style="border-bottom-right-radius:4px;border-bottom-left-radius:4px;display:none;width:50px;background-color:#3c76e7"><p class="text-center" style="color:white">{{$quests[$i]->user_name}}</p></div>
                                                </div>
                                          @endif
                                          @endfor
                                    </td>
                              </tr>
                              <tr>
                                    <td>已指派的冒險者</td>
                                    <td>
                                          @for($i=0;$i<count($quests);$i++)
                                          @if($quests[$i]->status == 1)
                                                <div style="margin-right:10px" class="col-md-1">
                                                      <img class="img user" name="{{$quests[$i]->user_id}}" style="border-top-left-radius:4px;border-top-right-radius:4px;width:50px;height:50px" src="{{asset('personal_img/'.$quests[$i]->picture_path)}}"></img>
                                                      <div class="namae" style="border-bottom-right-radius:4px;border-bottom-left-radius:4px;display:none;width:50px;background-color:#3c76e7"><p class="text-center" style="color:white">{{$quests[$i]->user_name}}</p></div>
                                                </div>
                                          @endif
                                          @endfor
                                    </td>
                              </tr>
                        </table>
                  </div>
                  <div class="panel-footer">
                        <div class="text-right">
                              <a class="btn btn-primary"><i class="icon-pencil"> 修改任務</i></a>
                              <a href="/questcommand/{{ $quests[0]->quest_id }}" class="btn btn-danger"><i class="icon-sitemap"> 下達任務指示</i></a>
                        </div>
                  </div>
            </div>
      </div>

	@endif
@endsection