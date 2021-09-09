<div class="card">
    <div class="card-header">
      <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid">
    </div>
    <div class="card-body"> 
       <h6>{{$product->prd_name}}</h6> 
       <p>{{$product->description}}</p>
      <div class="row">
        <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
        <div class="col-6"> <button class="btn btn-primary btn-block btn-danger"> <i class="fas fa-trash"></i> Delete</button>  </div>
      </div>
    </div>
</div>