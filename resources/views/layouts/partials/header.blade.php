<div class="row">	
  <div class="container">
    @if (Auth::guest())
		<h1>Hey, Friend! Welcome to Mission Life!</h1>
    @else
    <h1>{{ Auth::user()->name }}, Enjoy your Mission Life!</h1>
    @endif
	</div>
</div>

<div class="btn-group btn-group-justified" role="group">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">冒險者資料</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">成就瀏覽</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">技能系統</button>
  </div>
   <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">任務進行</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default">道具欄</button>
  </div>
  <div class="btn-group" role="group">
    @if (Auth::guest())
    <a type="button" class="btn btn-success" href="{{ url('/login') }}">登入</a>
    @else
    <a type="button" class="btn btn-warning" href="{{ url('/logout') }}">登出</a>
    @endif
  </div>
</div>