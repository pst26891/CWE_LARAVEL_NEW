  <div class="row">
      <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>

          <li class="breadcrumb-item"><a href="{{url('/')}}/admin/manage-menus/">Manage Menu</a></li>

         
      </ol>
  </div>

  <div class="message">
      <DIV class="row">
          <div class="col-md-12" style="color:red;">
              @if($errors->any())
              {!! implode('', $errors->all('<div>:message</div>')) !!}
              @endif
          </div>

          <div class="col-md-12" style="color:green;">
              @if (session('success'))
              <div class="alert alert-success">
                  <p class="msg"> {{ session('success') }}</p>
              </div>
              @endif
          </div>

      </DIV>

  </div>

  <div class="page-content fade-in-up">
      <div class="row">
          <div class="col-md-12">

              <div class="ibox">
                  <div class="ibox-head">
                      <div class="ibox-title">Menus</div>
                      <div class="ibox-tools">
                          <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                      </div>
                  </div>
                  <div class="ibox-body">
                      @php $desiredMenu = $desiredMenu;
                      $menuitems = $MenuItems; @endphp
                      <div class="col-md-12 row" style="margin-bottom: 20px;">

                          <script src="{{ url('/')}}/admin_assets/js/new_sortable.js"></script>
                         <div id="serialize_output">  
                            @if($desiredMenu)
                                {!! is_array($desiredMenu['content']) ? json_encode($desiredMenu['content']) : $desiredMenu['content'] !!}
                            @endif
                        </div>

                          <div class="container-fluid">

                              <div class="content info-box">
                                  @if(count($menus) > 0)
                                  Select a menu to edit:
                                  <form action="{{url('admin/manage-menus')}}" class="form-inline">
                                      <select name="id">
                                          @foreach($menus as $menu)
                                            @if($desiredMenu != '')
                                            <option value="{{$menu->id}}" @if($menu->id == $desiredMenu['id']) selected @endif>{{$menu->title}}</option>
                                            @else
                                            <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                            @endif
                                          @endforeach
                                      </select>
                                      <button class="btn btn-sm btn-default btn-menu-select">Select</button>
                                  </form>
                                  or <a href="{{url('admin/manage-menus?id=new')}}">Create a new menu</a>.
                                  @endif
                              </div>

                              <div class="row" id="main-row">
                                  <div class="col-sm-4 cat-form @if(count($menus) == 0) disabled @endif">
                                      <h3><span>Add Menu Items</span></h3>

                                      <div class="ibox-group" id="menu-items">
                                          <div class="ibox   ibox-success">
                                              <div class="ibox-head">
                                                  <a href="#categories-list" data-toggle="collapse" data-parent="#menu-items" class="clrwhite">Categories <span class="caret"></span></a>
                                              </div>
                                              <div class="ibox-collapse collapse in" id="categories-list">
                                                  <div class="ibox-body">
                                                      <div class="item-list-body">
                                                          @foreach($categories as $cat)
                                                          <p><input type="checkbox" name="select-category[]" value="{{$cat->id}}"> {{$cat->title}}</p>
                                                          @endforeach
                                                      </div>
                                                      <div class="item-list-footer">
                                                          <label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-categories"> Select All</label>
                                                          <button type="button" class="pull-right btn btn-default btn-sm" id="add-categories">Add to Menu</button>
                                                      </div>
                                                  </div>
                                              </div>
                                              <script>
                                                  $('#select-all-categories').click(function(event) {
                                                      if (this.checked) {
                                                          $('#categories-list :checkbox').each(function() {
                                                              this.checked = true;
                                                          });
                                                      } else {
                                                          $('#categories-list :checkbox').each(function() {
                                                              this.checked = false;
                                                          });
                                                      }
                                                  });
                                              </script>
                                          </div>

                                          <div class="ibox ibox-success">
                                              <div class="ibox-head">
                                                  <a href="#custom-links" data-toggle="collapse" data-parent="#menu-items" class="clrwhite">Custom Links <span class="caret"></span></a>
                                              </div>
                                              <div class="ibox-collapse collapse" id="custom-links">
                                                  <div class="ibox-body">
                                                      <div class="item-list-body">
                                                          <div class="form-group">
                                                              <label>URL</label>
                                                              <input type="url" id="url" class="form-control" placeholder="https://">
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Link Text</label>
                                                              <input type="text" id="linktext" class="form-control" placeholder="">
                                                          </div>
                                                      </div>
                                                      <div class="item-list-footer">
                                                          <button type="button" class="pull-right btn btn-default btn-sm" id="add-custom-link">Add to Menu</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-8 cat-view">
                                      <h3><span>Menu Structure</span></h3>

                                      @if($desiredMenu == '')
                                      <h4>Create New Menu</h4>
                                      <form method="post" action="{{url('admin/create-menu')}}">
                                          {{csrf_field()}}
                                          <div class="row">
                                              <div class="col-sm-12">
                                                  <label>Name</label>
                                              </div>
                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <input type="text" name="title" class="form-control">
                                                  </div>
                                              </div>
                                              <div class="col-sm-6 text-right">
                                                  <button class="btn btn-sm btn-primary">Create Menu</button>
                                              </div>
                                          </div>
                                      </form>
                                      @else
                                      @php if(isset($_GET['id']) && $_GET['id']=='new') { @endphp
                                        <h4>Create New Menu</h4>
                                        <form method="post" action="{{url('admin/createMenu')}}">
                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" name="title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-right">
                                                    <button class="btn btn-sm btn-primary">Create Menu</button>
                                                </div>
                                            </div>
                                        </form>
                                       @php } @endphp
                                      <div id="menu-content">
                                          <div id="result"></div>
                                          <div style="min-height: 240px;">
                                              <p>Select categories, pages or add custom links to menus.</p>
                                              @if($desiredMenu != '')
                                              <ul class="menu ui-sortable" id="menuitems">
                                                  @if(!empty($menuitems))
                                                 
                                                  @foreach($menuitems as $key=> $item)
                                                  <li data-id="{{$item['id']}}"><span class="menu-item-bar"><i class="fa fa-arrows"></i> @if(!empty($item['name'])) {{$item['name']}} @else {{$item['title']}} @endif <a href="#collapse{{$item['id']}}" class="pull-right" data-toggle="collapse"><i class="caret"></i></a></span>
                                                      <div class="collapse" id="collapse{{$item['id']}}">
                                                          <div class="input-box">
                                                              <form method="post" action="{{url('admin/update-menuitem')}}/{{$item['id']}}">
                                                                  {{csrf_field()}}
                                                                  <div class="form-group">
                                                                      <label>Link Name</label>
                                                                      <input type="text" name="name" value="@if(!empty($item['name'])) {{$item['name']}} @else {{$item['title']}} @endif" class="form-control">
                                                                  </div>
                                                                  @if(!empty($item['type']) && $item['type'] == 'custom')
                                                                  <div class="form-group">
                                                                      <label>URL</label>
                                                                      <input type="text" name="slug" value="{{$item['slug']}}" class="form-control">
                                                                  </div>
                                                                  <div class="form-group">
                                                                      <input type="checkbox" name="target" value="_blank" @if($item['target'] == '_blank') checked @endif> Open in a new tab
                                                                  </div>
                                                                  @endif
                                                                  <div class="form-group">
                                                                      <button class="btn btn-sm btn-primary">Save</button>
                                                                      <a href="{{url('admin/deleteMenuItem')}}/{{$item['id']}}/{{$key}}" class="btn btn-sm btn-danger">Delete</a>
                                                                  </div>
                                                              </form>
                                                          </div>
                                                      </div>
                                                      <ul>
                                                          @if(isset($item['children']))
                                                          @foreach($item['children'] as $m)
                                                          @foreach($m as $in=>$cdata)

                                                          <li data-id="{{$cdata['id']}}" class="menu-item"> <span class="menu-item-bar"><i class="fa fa-arrows"></i> @if(empty($cdata['name'])) {{$cdata['title']}} @else {{$cdata['name']}} @endif <a href="#collapse{{$cdata['id']}}" class="pull-right" data-toggle="collapse"><i class="caret"></i></a></span>
                                                              <div class="collapse" id="collapse{{$cdata['id']}}">
                                                                  <div class="input-box">
                                                                      <form method="post" action="{{url('admin/update-menuitem')}}/{{$cdata['id']}}">
                                                                          {{csrf_field()}}
                                                                          <div class="form-group">
                                                                              <label>Link Name</label>
                                                                              <input type="text" name="name" value="@if(empty($cdata['name'])) {{$cdata['title']}} @else {{$cdata['name']}} @endif" class="form-control">
                                                                          </div>
                                                                          @if($cdata['type'] == 'custom')
                                                                          <div class="form-group">
                                                                              <label>URL</label>
                                                                              <input type="text" name="slug" value="{{$cdata['slug']}}" class="form-control">
                                                                          </div>
                                                                          <div class="form-group">
                                                                              <input type="checkbox" name="target" value="_blank" @if($cdata['target'] == '_blank') checked @endif> Open in a new tab
                                                                          </div>
                                                                          @endif
                                                                          <div class="form-group">
                                                                              <button class="btn btn-sm btn-primary">Save</button>
                                                                              <a href="{{url('admin/deleteMenuItem')}}/{{$cdata['id']}}/{{$key}}/{{$in}}" class="btn btn-sm btn-danger">Delete</a>
                                                                          </div>
                                                                      </form>
                                                                  </div>
                                                              </div>

                                                              <ul>
                                                          @if(isset($cdata['children']))
                                                          @foreach($cdata['children'] as $q)
                                                          @foreach($q as $gin=>$gdata)

                                                          <li data-id="{{$gdata['id']}}" class="menu-item"> <span class="menu-item-bar"><i class="fa fa-arrows"></i> @if(empty($gdata['name'])) {{$gdata['title']}} @else {{$gdata['name']}} @endif <a href="#collapse{{$gdata['id']}}" class="pull-right" data-toggle="collapse"><i class="caret"></i></a></span>
                                                              <div class="collapse" id="collapse{{$gdata['id']}}">
                                                                  <div class="input-box">
                                                                      <form method="post" action="{{url('admin/update-menuitem')}}/{{$gdata['id']}}">
                                                                          {{csrf_field()}}
                                                                          <div class="form-group">
                                                                              <label>Link Name</label>
                                                                              <input type="text" name="name" value="@if(empty($gdata['name'])) {{$gdata['title']}} @else {{$gdata['name']}} @endif" class="form-control">
                                                                          </div>
                                                                          @if($gdata['type'] == 'custom')
                                                                          <div class="form-group">
                                                                              <label>URL</label>
                                                                              <input type="text" name="slug" value="{{$gdata['slug']}}" class="form-control">
                                                                          </div>
                                                                          <div class="form-group">
                                                                              <input type="checkbox" name="target" value="_blank" @if($gdata['target'] == '_blank') checked @endif> Open in a new tab
                                                                          </div>
                                                                          @endif
                                                                          <div class="form-group">
                                                                              <button class="btn btn-sm btn-primary">Save</button>
                                                                              <a href="{{url('admin/deleteMenuItem')}}/{{$gdata['id']}}/{{$key}}/{{$in}}/{{$gin}}" class="btn btn-sm btn-danger">Delete</a>
                                                                          </div>
                                                                      </form>
                                                                  </div>
                                                              </div>
                                                              <ul></ul>
                                                          </li>
                                                          @endforeach
                                                          @endforeach
                                                          @endif
                                                        </ul>
                                                          </li>
                                                          @endforeach
                                                          @endforeach
                                                          @endif
                                                      </ul>
                                                  </li>
                                                  @endforeach
                                                  @endif
                                              </ul>
                                              @endif
                                          </div>
                                          @if($desiredMenu != '')
                                          <div class="form-group menulocation">
                                              <label><b>Menu Location</b></label>
                                              <p><label><input type="radio" name="location" value="1" @if($desiredMenu['location'] == 1) checked @endif> Header</label></p>
                                              <p><label><input type="radio" name="location" value="2" @if($desiredMenu['location'] == 2) checked @endif> Main Navigation</label></p>
                                          </div>
                                          <div class="text-right">
                                              <button class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
                                          </div>
                                          <p><a href="{{url('admin/deleteMenu')}}/{{$desiredMenu['id']}}">Delete Menu</a></p>
                                          @endif
                                      </div>
                                      @endif
                                  </div>
                              </div>
                          </div>
                          <style>
                             
                              .ibox {border: 1px solid #cbcaca; }
                              .clrwhite {color: #fff !important;}
                              .item-list,.info-box{background: #fff;padding: 10px;}
  .item-list-body{max-height: 300px;overflow-y: scroll;}
  .panel-body p{margin-bottom: 5px;}
  .info-box{margin-bottom: 15px;}
  .item-list-footer{padding-top: 10px;}
  .panel-heading a{display: block;}
  .form-inline{display: inline;}
  .form-inline select{padding: 4px 10px;}
  .btn-menu-select{padding: 4px 10px}
  .disabled{pointer-events: none; opacity: 0.7;}
  .menu-item-bar{background: #eee;padding: 5px 10px;border:1px solid #d7d7d7;margin-bottom: 5px; width: 75%; cursor: move;display: block;}
  #serialize_output{display: none;}
  .menulocation label{font-weight: normal;display: block;}
  body.dragging, body.dragging * {cursor: move !important;}
  .dragged {position: absolute;z-index: 1;}
  ol.example li.placeholder {position: relative;}
  ol.example li.placeholder:before {position: absolute;}
  #menuitem{list-style: none;}
  #menuitem ul{list-style: none;}
  .input-box{width:75%;background:#fff;padding: 10px;box-sizing: border-box;margin-bottom: 5px;}
  .input-box .form-control{width: 50%}
  .cat-view h3,.cat-form h3{border-bottom:3px solid #838383 ;padding:3px 0px;}
  .cat-view h3 span,.cat-form h3 span{background-color: #838383; padding: 0px 5px;    color: #fff;}
  .info-box {
    margin-bottom: 15px;
    border: 1px solid #e6e6e6;
}
                          </style>

                      </div>
                  </div>
              </div>
              <!--ibox-->
          </div>
      </div>
  </div>
  <!-- END PAGE CONTENT-->
  @if($desiredMenu)
  <script>
      $('#add-categories').click(function() {
          var menuid = <?= $desiredMenu['id'] ?>;
          var n = $('input[name="select-category[]"]:checked').length;
          var array = $('input[name="select-category[]"]:checked');
          var ids = [];
          for (i = 0; i < n; i++) {
              ids[i] = array.eq(i).val();
          }
          if (ids.length == 0) {
              return false;
          }
          $.ajax({
              type: "get",
              data: {
                  menuid: menuid,
                  ids: ids
              },
              url: "{{url('admin/addCatToMenu')}}",
              success: function(res) {
                  location.reload();
              }
          })
      })
      $('#add-posts').click(function() {
          var menuid = <?= $desiredMenu['id'] ?>;
          var n = $('input[name="select-post[]"]:checked').length;
          var array = $('input[name="select-post[]"]:checked');
          var ids = [];
          for (i = 0; i < n; i++) {
              ids[i] = array.eq(i).val();
          }
          if (ids.length == 0) {
              return false;
          }
          $.ajax({
              type: "get",
              data: {
                  menuid: menuid,
                  ids: ids
              },
              url: "{{url('admin/addPostToMenu')}}",
              success: function(res) {
                  location.reload();
              }
          })
      })
      $("#add-custom-link").click(function() {
          var menuid = <?= $desiredMenu['id'] ?>;
          var url = $('#url').val();
          var link = $('#linktext').val();
          if (url.length > 0 && link.length > 0) {
              $.ajax({
                  type: "get",
                  data: {
                      menuid: menuid,
                      url: url,
                      link: link
                  },
                  url: "{{url('admin/addCustomLink')}}",
                  success: function(res) {
                      location.reload();
                  }
              })
          }
      })
  </script>
  @endif
  <script>
      var group = $("#menuitems").sortable({
          group: 'serialization',
          onDrop: function($item, container, _super) {
              var data = group.sortable("serialize").get();
              var jsonString = JSON.stringify(data, null, ' ');
              $('#serialize_output').text(jsonString);
              _super($item, container);
          }
      });
  </script>

  @if($desiredMenu)
  <script>
      $('#saveMenu').click(function() {
          var menuid = <?= $desiredMenu['id'] ?>;
          var location = $('input[name="location"]:checked').val();
          var newText = $("#serialize_output").text().trim();
            if (newText == '') {
                alert('Please add menu items');
                return false;
            }
            try {
                var data = JSON.parse(newText);
                $.ajax({
                    type: "get",
                    data: {
                        menuid: menuid,
                        data: data,
                        location: location
                    },
                    url: "{{url('admin/updateMenu')}}",
                    success: function(res) {
                        window.location.reload();
                    }
                })
            } catch (e) {
                console.error("Invalid JSON:", e);
                alert("Menu data is not in valid JSON format.");
                return;
            }
         
      })
  </script>
  @endif