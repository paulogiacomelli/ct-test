<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{csrf_token()}}" />

        <title>Coalition Technologies</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>
    <body class="pt-5">
        <div class="container">
            <div class="col-8 mx-auto">
                <div class="alert alert-danger" style="display:none"></div>
                <form id="form">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity in stock</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Product Quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price per item</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Product Price" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="submit">Add New Product</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container pt-5">
                <div class="alert alert-success" style="display:none">Product Added Succesfully</div>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                        <td>Product Name</td>
                        <td>Quantity in Stock</td>
                        <td>Price per Item</td>
                        <td>Datetime Submitted</td>
                        <td>Total Value Number</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php    
                            $total = 0;
                        @endphp
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>                              
                                <td>{{ $product->created_at }}</td>

                                <td>{{ $product->quantity * $product->price }}</td>
                                @php $total += ($product->quantity * $product->price) @endphp
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="total" style="font-weight:bold">{{ $total }}</td>
                            </tr>
                    </tbody>

                </table>
            </div>
    </body>
</html>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
<script src="js/main.js"></script>
