<div class="row">
  <div class="col s12">
    <form action="{{ route('search') }}" method="get">
      <div class="file-field input-field">
        <div class="btn btn-flat disabled no-padding">
          {{$user}}&#64;{{ config('app.name') }} {{$path}} 
        </div>
        <div class="file-path-wrapper">
          <input type="text" placeholder="search" 
              class="black-text search-input" name="keyword" 
              value="{{ \Request::get('keyword') }}" >
        </div>
      </div>
    </form>
  </div>
</div>