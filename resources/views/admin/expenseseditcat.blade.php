@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
   
</style>



<div class="row">
    <div class="col-12">
        <h5 class="mb-0 btn btn-sm mb-2 btn-danger" id="addExpenseBtn">ADD NEW EXPENSE</h5>
        <h5 class="mb-0 float-right btn btn-sm btn-primary" data-toggle="modal" data-target="#addmodal">ADD NEW CATEGORY</h5>
    </div>
</div>

<div class="row">
    @if (session('status'))
        <div class="alert alert-success col-md-6 offset-md-3 text-center mt-2">
            {{ session('status') }}
        </div>
    @endif
    @isset ($_GET['edited_successfully'])
        <div class="alert alert-success col-md-6 offset-md-3 text-center mt-2">
            {{ $_GET['edited_successfully'] }}
        </div>
    @endisset
    @isset ($_GET['deleted_successfully']))
        <div class="alert alert-success col-md-6 offset-md-3 text-center mt-2">
            {{ $_GET['deleted_successfully'] }}
        </div>
    @endisset

    <div class="col-12 table-responsive text-nowrap">
    <h5 class="mb-0 text-right btn btn-sm btn-primary mb-4" >EXPENSES CATEGORY</h5>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-md text-center">S/N</th>
                    <th class="text-md text-center">CATEGORY NAME</th>
                    <th class="text-md text-center" colspan="2">ACTION</th>
                </tr>
            </thead>
            <tbody class="text-center">
            @foreach($data as $expensecategory)
                <tr>
                    <td class="">{{$no}}</td> 
                    <td class="text-left">{{$expensecategory['expense_catname']}}</td> 
                    <!-- Button trigger modal -->
                    <td class="btn btn-sm btn-primary px-2 my-1" data-toggle="modal" data-target="#editModal"
                        data-name="{{$expensecategory['expense_catname']}}" data-id="{{$expensecategory['id']}}">EDIT</td> 
                    <td class="btn btn-sm btn-danger mx-2 float-right my-1" data-toggle="modal" data-target="#deleteModal" 
                        data-name="{{$expensecategory['expense_catname']}}" data-id="{{$expensecategory['id']}}">DELETE</td>
                    <p class="d-none">{{$no++}}</p>
                </tr>
               
            @endforeach   
            </tbody>
        </table>
    </div>
</div>


<!-- Add New Category Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Expense Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('cat_newname')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col form-group">
                            <label for="catname">Title</label>
                        </div>
                        <div class="col form-group">       
                            <input type="text" name="cat_name" required>
                        </div>
                    </div>
                </div>
                <div class="text-right pr-4 form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Expense Category Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="editForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="catname" >New Title</label>
                        </div>
                        <div class="col form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                            <input type="text" name="catName" required>
                        </div>
                        <p id="showResponse"></p>
                    </div> 
                </div>
                <div class="text-right pr-4 form-group">
                    <input type="text" name="currentId" id="idInput" class="d-none" >
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                    <button type="submit" class="btn btn-primary" id="editButton">Change</button>
                </div>
            </form>  
        </div>
    </div>
</div>



<!-- Delete modal -->
<div class="modal fade" id ="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Expense Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="delete" method="POST">
                <!-- <input type="hidden" name="_method" value="delete" />-->
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <div class="modal-body form-group">
                <p id="doublecheck"></p>
                </div>
                <div class="text-right pr-4 mt-0 form-group">
                    <input type="number" name="currentId" id="idInput" class="d-none">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                    <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>   
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>



<script type="text/javascript">
    $(document).ready(function(){
       
        $('#deleteModal').on('show.bs.modal', function(e) {
            let namee = $(e.relatedTarget).data('name');
            let id = $(e.relatedTarget).data('id');
            //populate the textbox
            $(e.currentTarget).find('#doublecheck').html('Are you sure you want to delete <b>'+namee+'</b> category ?');
            $(e.currentTarget).find('input[name="currentId"]').val(id);
            //$(e.currentTarget).find('#delete').prop('action','/company/expenses/delete_catergory'+id);        
        })
        $('#deleteButton').click(function(){
                event.preventDefault();
                let newId=$('#deleteModal #idInput').val();
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url:"{{'/company/expenses/delete_catergory'}}"+newId,
                    type:'post',
                    dataType:'text',  // expenses_cat
                    success:function(success){
                    //  $(window).attr('location','/company/expenses/add_or_delete_catergory?deleted_successfully='+success);
                        $(window).attr('location','{{route("expenses_cat", ["add_or_delete_catergory"=>'+success+'])}}')
                    },
                    error:function(error) {
                        console.log(error);
                    }
                })
        })
        

        $('#editModal').on('show.bs.modal', function(e) {
            let namee = $(e.relatedTarget).data('name');
            let id = $(e.relatedTarget).data('id');
            $(e.currentTarget).find('input[name="catName"]').val(namee);
            $(e.currentTarget).find('input[name="currentId"]').val(id);
           
        
            $('#editButton').click(function(){
                event.preventDefault();
                let newId=$('#editModal #idInput').val();
                let newName=$('input[name="catName"]').val();
                //$('#editForm').prop('action','/company/expenses/edit_catergory'+newId)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url:"{{'/company/expenses/edit_catergory'}}"+newId,
                    type:'post',
                    data:{'catName':newName,'id': newId },
                    dataType:'text',
                    success:function(success){
                       // $(window).attr('location','/company/expenses/add_or_delete_catergory?edited_successfully='+success);
                       $(window).attr('location','{{route("expenses_cat", ["add_or_delete_catergory"=>'+success+'])}}')
                    },
                    error:function(error){
                        console.log(error);
                        
                    }
                })
                
            })
        
        })

        $('#addExpenseBtn').click(function (){
         //   $(window).attr('location','/company/expenses/add_newexpenses');
            $(window).attr('location','{{route("new_expense")}}');
        })

       
    })
</script>
@endsection
