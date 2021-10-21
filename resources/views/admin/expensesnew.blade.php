@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<style>
   
</style>

<div class="row px-2">
    <div class="col-12 card">
        <form class="form" enctype="multipart/form-data" action="{{route('save_new_expense')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-0 text-right btn btn-sm btn-primary mt-4 mb-4 ml-md-5" >NEW EXPENSES</h5>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-2 offset-md-9">
                    <div class="row">
                        <label for="date" class="col-12">Expenses Date</label>
                        <input type="date" id="date" name="date" class="col-12 form-control form-control-sm" required>
                    </div>
                </div>
            </div>
            <div class="row form-group justify-content-center">
                <div class="col-md-5 mx-md-3 mb-1">
                    <div class="row">
                        <label for="name" class="col-12 mb-1">Expenses Initiator</label>
                        <input type="text" id="name" name="name" class="col-12 form-control form-control-sm" required>
                    </div>
                </div>
        
                <div class="col-md-5 mx-md-3 mb-1">
                    <div class="row">
                        <label for="expcat" class="col-12 mb-1">Expenses Category</label>
                        <select id="expcat" name="cat_name" class="col-12 form-control form-control-sm" required>
                            <option value="" class="text-center">--SELECT--</option>
                            @foreach($category as $category)
                                <option value="{{$category['id']}}">{{$category['expense_catname']}}</option>
                            @endforeach
                            <option value="New-Category" class="text-center text-danger">Add New Category</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="row form-group justify-content-center">
                <div class="col-md-5 mx-md-3 mb-1">
                    <div class="row">
                        <label for="branch" class="col-12 mb-1">Branch</label>
                        <select name="branch" class="col-12 form-control form-control-sm" required>
                            <option value="" class="text-center">--SELECT--</option>
                            <option value="Maryland"> Lagos State-Maryland</option>
                            <option value="Adekoya,Square-Anthony"> Lagos State- 9, Adekoya Square, Anthony</option>
                        </select>
                    </div>
                </div>
        
                <div class="col-md-5 mx-md-3 mb-1">
                    <div class="row">
                        <label for="amt" class="col-12 mb-1">Expenses Amount</label>
                        <input type="number" id="amt" name="amount" class="col-12 form-control form-control-sm" required onchange="loadFile(event)">
                    </div>
                </div>
                
            </div>
            
            <div class="row form-group justify-content-center">
                <div class="col-md-5 mx-md-3 mb-1">
                    <div class="row">
                        <div class="col-7">
                            <div class="row">
                                <label for="amt" class="col-12 mb-1"><i class="fas fa-photo-video"></i>Expenses Reciept</label>
                                <input type="file" id="proof" name="proof"class="form-control-file col-12 form-control form-control-sm "required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row float-right">
                                <img src="{{url('images/evidence.jfif')}}" alt="Evidence" class="col-12" id="output" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mx-md-3 mb-1">
                    <div class="row">
                        <label for="name" class="col-12 mb-1">Expenses Description</label>
                        <textarea id="desc" name="desc" class="col-12 form-control form-control-sm"required row="2"></textarea>
                    </div>
                </div>
                
                
            </div>
        
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-sm btn-block mb-2">SAVE</button>
                </div>
            </div>
        </form>
    </div>
</div>

 



<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // this will help preview proof before submitting
        $("#proof").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#output').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#expcat').change(function () {
            let valueSelected =$("#expcat option:selected").val();
                if(valueSelected=='New-Category'){
                    $(window).attr('location',"{{route('cat_newname')}}")
            }
        });
    })
</script>
@endsection
