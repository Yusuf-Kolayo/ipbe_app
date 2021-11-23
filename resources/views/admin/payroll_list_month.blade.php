@extends('layouts.main')
@section('content')

<style>

</style>

<div class="container-fluid table-responsive">
    <table id="example" class="datatable-init table table-sm table-bordered table-striped display nowrap">
        <thead class="thead">
            <tr>
                <th>SL#</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Employee Type</th>
                <th>Basic Salary</th>
                <th>Gross Salary</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
            <tbody class="t-body" >
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Olaniyi olamide</th>
                    <th>Agent</th>
                    <th>Full staff</th>
                    <th>100000</th>
                    <th>100000</th>
                    <th>1000</th>
                    <th>90000</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </tbody>
    </table>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').dataTable( {
  scroll: 300,
  scrollCollapse: true
} );
    });
</script>
@endsection