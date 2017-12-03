<div class="row no-margin">
    <div class="col s12 " >
      <div class="row no-margin" id="topbarsearch">
          <form action="{{ route('search') }}" method="get">
          <div class="input-field col s6 s12 black-text">
            <i class="black-text material-icons prefix">search</i>
            <input type="text" placeholder="search" 
              class="black-text search-input" name="keyword" 
              value="{{ \Request::get('keyword') }}" 
            >
          </div>
          </form>
        </div>
    </div>
</div>