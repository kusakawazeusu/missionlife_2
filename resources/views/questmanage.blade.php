@extends('layouts.main')

@section('title','管理任務')

@section('dialog')
@endsection

@section('content')
	@if(!Auth::Guest() && Auth::user()->auth=='1')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script>
            $(document).ready(function(){

                  $('.day').click(function(){
                        var date = $(this).attr("name");
                        $(this).text( $(this).load("howfar/"+date) );
                  });

                  $('.day').trigger( "click" );
            });
            </script>
            <div class="col-md-2 col-md-offset-1">
                  <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a data-toggle="tab" href="#before">報名尚未開始的任務</a></li>
                        <li @if(count($quests_now)==0) class="disabled" @endif><a data-toggle="tab" href="#now">招募中的任務</a></li>
                        <!--<li @if(count($quests_now)==0) class="disabled" @endif><a data-toggle="tab" href="#">進行中的任務</a></li>-->
                        <li @if(count($quests_finished)==0) class="disabled" @endif><a data-toggle="tab" href="#finished">已完成的任務</a></li>
                  </ul>
            </div>
            <div class="col-md-8">
                  <div class="tab-content">
                        @if(count($quests_before))
                        <div id="before" class="tab-pane fade in active">
                              <table class="table table-hover table-bordered">
                                    <thead>
                                          <tr>
                                                <th>任務標題</th>
                                                <th>任務類別</th>
                                                <th>發布單位</th>
                                                <th>開始時間</th>
                                                <th>結束時間</th>
                                                <th>需要人數</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=0; $i < count($quests_before); $i++)
                                          <tr>
                                                <td>{{ $quests_before[$i]->name }}</td>
                                                @if($quests_before[$i]->catalog==0)
                                                      <td>工讀</td>
                                                @elseif($quests_before[$i]->catalog==1)
                                                      <td>活動</td>
                                                @else
                                                      <td>講座</td>
                                                @endif
                                                <td>{{ $quests_before[$i]->creator }}</td>
                                                <td>{{ $quests_before[$i]->start_at }}（還有<b name="{{ $quests_before[$i]->start_at }}" class="day"></b>天）</td>
                                                <td>{{ $quests_before[$i]->end_at }}（還有<b name="{{ $quests_before[$i]->end_at }}" class="day"></b>天）</td>
                                                <td>{{ $quests_before[$i]->workforce }}</td>
                                          </tr>
                                    @endfor
                                    </tbody>
                              </table>
                        </div>
                        @endif

                        @if(count($quests_now))
                        <div id="now" class="tab-pane fade">
                              <table class="table table-hover table-bordered">
                                    <thead>
                                          <tr>
                                                <th>任務標題</th>
                                                <th>任務類別</th>
                                                <th>發布單位</th>
                                                <th>開始時間</th>
                                                <th>結束時間</th>
                                                <th>需要人數</th>
                                                <th>申請人數</th>
                                                <th>審核</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @for($i=0; $i < count($quests_now); $i++)
                                                <tr>
                                                      <td>{{ $quests_now[$i]->name }}</td>
                                                      @if($quests_now[$i]->catalog==0)
                                                            <td>工讀</td>
                                                      @elseif($quests_now[$i]->catalog==1)
                                                            <td>活動</td>
                                                      @else
                                                            <td>講座</td>
                                                      @endif
                                                      <td>{{ $quests_now[$i]->creator }}</td>
                                                      <td>{{ $quests_now[$i]->start_at }}（已進行<b name="{{ $quests_now[$i]->start_at }}" class="day"></b>天）</td>
                                                      <td>{{ $quests_now[$i]->end_at }}（還有<b name="{{ $quests_now[$i]->end_at }}" class="day"></b>天）</td>
                                                      <td>{{ $quests_now[$i]->workforce }}</td>
                                                      <td>{{ $applies[$quests_now[$i]->name] }}</td>
                                                      @if($quests_now[$i]->catalog==0)
                                                            <td class="text-center"><a href="/questmanage/{{$quests_now[$i]->id}}"><i class="icon-check icon-large"></i></a></td>
                                                      @elseif($quests_now[$i]->catalog==1)
                                                            <td class="text-center"><a href="/questmanage/{{$quests_now[$i]->id}}"><i class="icon-check icon-large"></i></a></td>
                                                      @else
                                                            <td class="text-center"><a href="/confQRcode/{{$quests_now[$i]->id}}"><i class="icon-check icon-large"></i></a></td>
                                                      @endif
                                                </tr>
                                          @endfor
                                    </tbody>
                              </table>
                        </div>
                        @endif

                        @if(count($quests_finished))
                        <div id="finished" class="tab-pane fade">
                              <table class="table table-hover table-bordered">
                                    <thead>
                                          <tr>
                                                <th>任務標題</th>
                                                <th>任務類別</th>
                                                <th>發布單位</th>
                                                <th>開始時間</th>
                                                <th>結束時間</th>
                                                <th>獎勵冒險點數</th>
                                                <th>薪資</th>
                                                <th>需要人數</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @for($i=0; $i < count($quests_finished); $i++)
                                                <tr>
                                                      <td>{{ $quests_finished[$i]->name }}</td>
                                                      @if($quests_finished[$i]->catalog==0)
                                                            <td>工讀</td>
                                                      @elseif($quests_finished[$i]->catalog==1)
                                                            <td>活動</td>
                                                      @else
                                                            <td>講座</td>
                                                      @endif
                                                      <td>{{ $quests_finished[$i]->creator }}</td>
                                                      <td>{{ $quests_finished[$i]->start_at }}</td>
                                                      <td>{{ $quests_finished[$i]->end_at }}</td>
                                                      <td>{{ $quests_finished[$i]->point }}</td>
                                                      <td>{{ $quests_finished[$i]->salary }}</td>
                                                      <td>{{ $quests_finished[$i]->workforce }}</td>
                                                </tr>
                                          @endfor
                                    </tbody>
                              </table>
                        </div>
                        @endif
                  </div>
            </div>
	@endif
@endsection