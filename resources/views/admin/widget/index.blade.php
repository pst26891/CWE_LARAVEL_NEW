  <div class="row">
      <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>

          <li class="breadcrumb-item"><a href="{{url('/')}}/admin/widget/">Widget List</a></li>

          <li class="breadcrumb-menu">
              <ul style="list-style-type: none;">
                  <li> <a class="btn btn-outline-primary" href="{{url('/')}}/admin/widget/create"><i class="fa fa-plus"></i> New Widget</a></li>
              </ul>
          </li>
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
                      <div class="ibox-title">Widget List</div>
                      <div class="ibox-tools">
                          <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                      </div>
                  </div>
                  <div class="ibox-body">
                      <div class="col-md-12 row" style="margin-bottom: 20px;">
                          <form class="form-inline" method="GET" action="{{url('/')}}/admin/widget/search">
                              {{csrf_field()}}
                              <input name="sname" class="form-control mb-2 mr-sm-2 mb-sm-0" id="sname" type="text" placeholder="Search by Name">
                              <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="status" name="status">
                                  <option value="">Search by Status</option>
                                  <option value="0">Active</option>
                                  <option value="1">Inactive</option>
                              </select>

                              <button class="btn btn-success" type="submit">Search</button> &nbsp;
                              <a class="btn btn-default" href="{{url('/')}}/admin/widget/">Reset</a>
                          </form>
                      </div>

                      <div class="table-responsive">
                          <table id="pages-table" class="table table-bordered">
                              <thead class="thead-default">
                                  <tr>
                                      <th>No.</th>
                                      <th>Layout Type</th>

                                      <th>Widget Name</th>
                                      <th>Order</th>

                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if($mlist && $mlist->count() > 0)
                                  @php $i = $mlist->perPage()*($mlist->currentPage()-1); @endphp
                                  @foreach($mlist as $row)
                                  <tr>
                                      <td>{{++$i}}</td>
                                      <td>@php if($row->layout_type==1) echo "Left Sidebar"; else echo "Right Sidebar";@endphp</td>
                                      <td>{{$row->name}}</td>
                                      <td>{{$row->order}}</td>

                                      <td>@php if($row->status==0) echo "<span class='label label-success'>Active<span>"; else echo "<span class='label label-danger'>Inactive</span>";@endphp</td>
                                      <td><a href="{{url('/')}}/admin/widget/edit/{{$row->id}}" title="Edit widget"><i class="fa fa-edit"></i></a></td>
                                  </tr>

                                  @endforeach
                                  @if($mlist->total()==0)
                                  <tr>
                                      <td colspan="5"><strong>No record found. <a href="{{url('/')}}/admin/widget/" title="Reset">Back to List</a></strong></td>
                                  <tr>
                                      @endif
                                      @endif
                              </tbody>
                          </table>
                          <div class="d-flex">
                              <div class="mx-auto">
                                  {{ $mlist->links("pagination::bootstrap-4") }}

                              </div>
                          </div>


                      </div>
                      <!--row-->

                  </div>
                  <!--card-body-->
              </div>
              <!--card-->

          </div>
          <!-- END PAGE CONTENT-->