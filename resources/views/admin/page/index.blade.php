  <div class="row">
      <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
              <a href="{{ url('/admin/pages') }}">Pages List</a>
          </li>
          <li class="breadcrumb-menu">
              <ul style="list-style-type: none;">
                  <li>
                      <a class="btn btn-outline-primary" href="{{ url('/admin/pages/create') }}">
                          <i class="fa fa-plus"></i> New Page
                      </a>
                  </li>
              </ul>
          </li>
      </ol>
  </div>
  <div class="page-content fade-in-up">
      <div class="row">
          <div class="col-md-12">

              <div class="ibox">
                  <div class="ibox-head">
                      <div class="ibox-title">Pages List</div>
                      <div class="ibox-tools">
                          <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                      </div>
                  </div>
                  <div class="ibox-body">
                      <div class="col-md-12 row" style="margin-bottom: 20px;">
                          <form class="form-inline" method="GET" action="{{ route('admin.pages.search') }}">
                              <input name="sname" class="form-control mb-2 mr-sm-2" type="text"
                                  value="{{ request('sname') }}" placeholder="Search by Name">

                              <select class="form-control mb-2 mr-sm-2" name="status">
                                  <option value="">Search by Status</option>
                                  <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                  <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                              </select>

                              <button class="btn btn-success" type="submit">Search</button>
                              <a class="btn btn-default" href="{{ url('/admin/pages') }}">Reset</a>
                          </form>

                      </div>

                      <div class="table-responsive">
                          <table id="pages-table" class="table table-bordered">
                              <thead class="thead-default">
                                  <tr>
                                      <th>No.</th>
                                      <th>Page Name</th>
                                      <th data-orderable="false">Order</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @if($pages->isNotEmpty())
                                  @php $i = $pages->perPage() * ($pages->currentPage() - 1); @endphp
                                  @foreach($pages as $page)
                                  <tr>
                                      <td>{{ ++$i }}</td>
                                      <td>{{ $page->title }}</td>
                                      <td>{{ $page->ord }}</td>
                                      <td>
                                          @if($page->status == 1)
                                          <span class="label label-success">Active</span>
                                          @else
                                          <span class="label label-danger">Inactive</span>
                                          @endif
                                      </td>
                                      <td>
                                          <a href="{{ url('/admin/pages/edit/' . $page->id) }}" title="Edit Page">
                                              <i class="fa fa-edit"></i>
                                          </a>
                                      </td>
                                  </tr>
                                  @endforeach
                                  @else
                                  <tr>
                                      <td colspan="5">
                                          <strong>No record found.
                                              <a href="{{ url('/admin/pages') }}" title="Reset">Back to List</a>
                                          </strong>
                                      </td>
                                  </tr>
                                  @endif
                              </tbody>
                          </table>
                          <div class="d-flex justify-content-center">
                              {{ $pages->links('pagination::bootstrap-4') }}
                          </div>


                      </div>
                      <!--row-->

                  </div>
                  <!--card-body-->
              </div>
              <!--card-->

          </div>
          <!-- END PAGE CONTENT-->