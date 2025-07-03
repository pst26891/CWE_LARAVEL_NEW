  <div class="row">
      <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>

          <li class="breadcrumb-item"><a href="{{url('/')}}/admin/issue/">Issue List</a></li>

          <li class="breadcrumb-menu">
              <ul style="list-style-type: none;">
                  <li> <a class="btn btn-outline-primary" href="{{url('/')}}/admin/issue/create"><i class="fa fa-plus"></i> New Issue</a></li>
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
                      <div class="ibox-title">Issue List</div>
                      <div class="ibox-tools">
                          <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                      </div>
                  </div>
                  <div class="ibox-body">
                      <div class="col-md-12 row" style="margin-bottom: 20px;">
                          

                          <form class="form-inline" method="GET" action="{{url('/')}}/admin/issue/search">
                              {{csrf_field()}}
                              <input name="sname" class="form-control mb-2 mr-sm-2 mb-sm-0" id="sname" type="text" placeholder="Search by Name">
                              <select class="form-control mb-2 mr-sm-2 mb-sm-0" id="status" name="status">
                                  <option value="">Search by Status</option>
                                  <option value="0">Active</option>
                                  <option value="1">Inactive</option>
                              </select>

                              <button class="btn btn-success" type="submit">Search</button> &nbsp;
                              <a class="btn btn-default" href="{{url('/')}}/admin/issue/">Reset</a>
                          </form>
                      </div>

                      <div class="table-responsive">
                          <table id="pages-table" class="table table-bordered">
                              <thead class="thead-default">
                                  <tr>
                                      <th>No.</th>
                                      <th>Volume</th>
                                      <th>Issue</th>
                                      <th>Edition</th>
                                      <th>Current</th>
                                      <th>Coming</th>
                                      <th>Special</th>
                                      <th>Pages</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if($mlist && !empty($mlist))
                                  @php $i = $mlist->perPage()*($mlist->currentPage()-1); @endphp
                                  @foreach($mlist as $row)
                                  <tr>
                                      <td>{{++$i}}</td>
                                      <td>{{ $row->volume->name ?? 'N/A' }}</td>
                                      <td>{{$row->name}}</td>
                                      <td>{{$row->edition}}</td>
                                      <td>@php
                                          echo ($row->current==1) ?'<a href="" title="Active"><img src="'.url('/').'/admin_assets/img/check.png" style="width:25px" /></a>':
                                          '<a href="/admin/issue/change-status/'.$row->id.'/current/" title="Inctive" style="color:grey"><i class="fa fa-ban fa-2x"></i></a>';
                                          @endphp
                                      </td>

                                      <td>@php
                                          echo ($row->coming==1) ?'<a href="" title="Active"><img src="'.url('/').'/admin_assets/img/check.png" style="width:25px" /></a>':
                                          '<a href="/admin/issue/change-status/'.$row->id.'/coming/" title="Inctive" style="color:grey"><i class="fa fa-ban fa-2x"></i></a>';
                                          @endphp
                                      </td>

                                      <td>@php
                                          echo ($row->special==1) ?'<a href="" title="Active"><img src="'.url('/').'/admin_assets/img/check.png" style="width:25px" /></a>':
                                          '<a href="/admin/issue/change-status/'.$row->id.'/special/" title="Inctive" style="color:grey"><i class="fa fa-ban fa-2x"></i></a>';
                                          @endphp
                                      </td>

                                      <td>{{$row->pages}}</td>

                                      <td>@php if($row->status==0) echo "<span class='label label-success'>Active<span>"; else echo "<span class='label label-danger'>Inactive</span>";@endphp</td>
                                      <td><a href="{{url('/')}}/admin/issue/edit/{{$row->id}}" title="Edit Page"><i class="fa fa-edit"></i></a></td>
                                  </tr>

                                  @endforeach
                                  @if($mlist->total()==0)
                                  <tr>
                                      <td colspan="5"><strong>No record found. <a href="{{url('/')}}/admin/issue/" title="Reset">Back to List</a></strong></td>
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