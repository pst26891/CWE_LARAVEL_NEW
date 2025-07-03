 <style>
     .filterfrm input,
     .filterfrm select {
         margin-bottom: 3px !important;
     }
 </style>
 <div class="row">
     <ol class="breadcrumb">
         <li class="breadcrumb-item">Home</li>

         <li class="breadcrumb-item"><a href="{{url('/')}}/admin/articles/">Artcle List</a></li>

         <li class="breadcrumb-menu">
             <ul style="list-style-type: none;">
                 <li> <a class="btn btn-outline-primary" href="{{url('/')}}/admin/articles/create"><i class="fa fa-plus"></i> New Article</a></li>
             </ul>
         </li>
     </ol>
 </div>

 <div class="message">
     <DIV class="row">

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
                     <div class="ibox-title">Article List</div>
                     <div class="ibox-tools">
                         <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                     </div>
                 </div>
                 <div class="ibox-body">
                     <meta name="csrf-token" content="{{ csrf_token() }}">

                     <div class="col-md-12 row filterfrm" style="margin-bottom: 10px;">
                         <form action="{{ url('/admin/articles/search') }}" method="GET" class="form-inline">
                             @csrf

                             {{-- Page Show Dropdown --}}
                             <select class="form-control-sm mb-2 mr-sm-2 mb-sm-0 input-sm" id="pageshow" name="pageshow">
                                 <option value="20">20</option>
                                 <option value="50">50</option>
                                 <option value="100">100</option>
                             </select>

                             {{-- Search by Name --}}
                             <input type="text" name="sname" class="form-control-sm mb-2 mr-sm-2 mb-sm-0" id="sname"
                                 placeholder="Search by Name" style="border:1px solid #5d5a5a">

                             {{-- Search by Volume --}}
                             <select name="volumes" class="form-control-sm mb-2 mr-sm-2 mb-sm-0" id="volumeId">
                                 <option value="">Search by Volume</option>
                                 @foreach ($volumes as $key => $volume)
                                 <option value="{{ $key }}">{{ $volume }}</option>
                                 @endforeach
                             </select>

                             {{-- Search by Issue --}}
                             <select class="form-control-sm mb-2 mr-sm-2 mb-sm-0" id="issue_id" name="issue">
                                 <option value="">Search by Issue</option>
                             </select>

                             {{-- Search by Status --}}
                             <select class="form-control-sm mb-2 mr-sm-2 mb-sm-0" id="status" name="status">
                                 <option value="">Search by Status</option>
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                             </select>

                             {{-- Submit Button --}}
                             <button class="btn btn-success btn-sm" type="submit">Search</button> &nbsp;

                             {{-- Reset Button --}}
                             <a class="btn btn-default btn-sm" href="{{ url('/admin/articles/') }}">Reset</a>
                         </form>

                     </div>


                     <div class="table-responsive">
                         <table id="pages-table" class="table table-bordered">
                             <thead class="thead-default">
                                 <tr>
                                     <th>No.</th>
                                     <th>Article Name</th>
                                     <th>Manuscript No</th>
                                     <th>Volume</th>
                                     <th>Issue</th>

                                     <th>Date</th>

                                     <th>Status</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody class="list-groupi shadow-lg connectedSortable" id="padding-item-drop">
                                 @if($mlists && !empty($mlists))
                                 @php $i =$mlists->perPage()*($mlists->currentPage()-1); @endphp
                                 @foreach($mlists as $row)
                                 <tr class="list-group-itemi" item-id="{{ $row->id }}">
                                     <td>{{++$i}}</td>
                                     <td>{{$row->title}}</td>
                                     <td>{{$row->manuscript_no}}</td>
                                     <td> {{ $row->volumeInfo->name ?? '' }}</td>
                                     <td>{{$row->issue->name}}</td>
                                     <td>{{$row->date}}</td>

                                     <td>@php if($row->status==0) echo "<span class='label label-success'>Active<span>"; else echo "<span class='label label-danger'>Inactive</span>";@endphp</td>
                                     <td><a href="{{url('/')}}/admin/articles/edit/{{$row->id}}" title="Edit Page"><i class="fa fa-edit"></i></a></td>
                                 </tr>

                                 @endforeach
                                 @if($mlists->total()==0)
                                 <tr>
                                     <td colspan="5"><strong>No record found. <a href="{{url('/')}}/admin/articles/" title="Reset">Back to List</a></strong></td>
                                 <tr>
                                     @endif
                                     @endif
                             </tbody>
                         </table>
                         <div class="d-flex">
                             <div class="mx-auto">
                                 {{ $mlists->links("pagination::bootstrap-4") }}


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
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

         <script>
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $(document).ready(function() {
                 $('#volumeId').on('change', function(e) {
                     var volume_id = e.target.value;
                     $.ajax({
                         url: "{{ url('admin/articles/issueByVolume') }}",
                         type: "POST",
                         data: {
                             volume_id: volume_id
                         },
                         success: function(data) {
                             //console.log(data);
                             $('#issue_id').empty();
                             $('#issue_id').append('<option value="">Select Issue</option>');

                             $.each(data.issues, function(index, issue) {
                                 $('#issue_id').append('<option value="' + issue.id + '">' + issue.name + '</option>');
                             })
                         }
                     })
                 });
             });


             $(function() {
                 $("#padding-item-drop, #complete-item-drop").sortable({
                     connectWith: ".connectedSortable",
                     opacity: 0.5,
                 });
                 $(".connectedSortable").on("sortupdate", function(event, ui) {
                     var pending = [];
                     var accept = [];
                     $("#padding-item-drop tr").each(function(index) {
                         if ($(this).attr('item-id')) {
                             pending[index] = $(this).attr('item-id');
                         }
                     });
                     //  $("#complete-item-drop li").each(function(index) {
                     //      accept[index] = $(this).attr('item-id');
                     //  });

                    
                 });
             });
         </script>