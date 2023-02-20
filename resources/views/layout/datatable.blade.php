<!-- ............................................ seller ............................................ -->
@if(Request::segment(1) == 'sold')
<div class=" table table-hover table-responsive-lg table-borderless">
    <table id="data-table" class="table">
        <thead>
            <tr class="text-center">
                <th>Cashier </th>
                <th>Barcode </th>
                <th>Name </th>
                <th>Price </th>
                <th>Price At </th>
                <th>EXPIRE DATE </th>
                <th>CREATED AT </th>
                <th>SOLD AT </th>
                <th>Piece </th>
                @if(Request::segment(1) != 'sold')
                <th>Undo</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($solds as $sold)
            <tr class="text-center">
                <th>{{$sold->chashier->name}}</th>
                <td>
                    @if($sold->one_stock->type == 0)
                    {!!DNS1D::getBarcodeSVG("$sold->stock_id", 'EAN13' , 1,28 , 'dark', true)!!}
                    @else
                    {!!DNS2D::getBarcodeSVG("$sold->stock_id", 'QRCODE' , 1,1)!!}
                    @endif
                </td>
                <td>{{$sold->one_stock->name}}</td>
                <td>{{number_format($sold->one_stock->price , 0 , '.' , '.')}} IQD</td>
                <td>{{number_format($sold->price_at , 0 , '.' , '.')}} IQD</td>
                <td>{{$sold->one_stock->expire_date}}</td>
                <td>{{$sold->one_stock->created_at}}</td>
                <td>{{$sold->created_at}}</td>
                <td class="bg-darker text-white border border-white mt-5">{{$sold->piece}}</td>
                @if(Request::segment(1) != 'sold')
                <td class="bg-danger text-white border border-white" onclick="undo(`{{$sold->id}}`)"><i
                        class="fas fa-undo-alt"></i></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<!-- ............................................  end seller ............................................ -->


<!--  ............................................ cashier ............................................ -->
@if(Request::segment(1) == 'cashier')
<div class=" table table-hover table-responsive-sm">
    <table id="data-table" class="table">
        <thead>
            <tr class="text-center">
                <th>Name </th>
                <th>Email </th>
                <th>Rule </th>
                <th>Action </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cashiers as $cashier)
            <tr class="text-center ml-8">
                <td>{{$cashier->name}}</td>
                <td>{{$cashier->email}}</td>
                <td>{{$cashier->rule == 1 ? "Admin" : "Cashier"}}</td>
                <td><span class="btn btn-danger btn-sm " data-toggle="modal"
                        data-target="#delete{{$cashier->id}}">Delete</span></td>

            </tr>

            <!-- Modal Delete -->
            <div class="modal fade" id="delete{{$cashier->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span>Do You Want To Delete {{$cashier->name}}</span>
                            <form action="cashier/1/{{$cashier->id}}" method="POST">
                                @csrf
                                <button class="btn btn-danger w-100 mt-4 radius-20">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>
@endif
<!-- ............................................ end cashier ............................................ -->


<!-- ............................................ (stocks) ............................................ -->

@if((Request::segment(1) == 'buy') || (Request::segment(1) == 'notleft') || (Request::segment(1) == 'expire') ||
(Request::segment(1) == 'debtlist') )

<div class=" table table-hover table-responsive-sm">
    <table id="data-table" class="table">
        <thead>
            <tr class="text-center">
                <th>Barcode </th>
                <th>Barcode Number </th>
                <th>Name </th>
                <th>Supplier </th>
                <th>Count </th>
                <th>Price </th>
                <th>Expire </th>
                <th>Create At </th>
                <th>Action </th>
                <th>Is debt? </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
            <tr class="text-center ml-8">
                <td>@if($stock->type == 0)
                    {!!DNS1D::getBarcodeSVG("$stock->id", 'C128', 1,24 , 'dark', false)!!}
                    @else
                    {!!DNS2D::getBarcodeSVG("$stock->id", 'QRCODE' , 1,1)!!}
                    @endif</td>
                <td>{{$stock->id}}</td>
                <td>{{$stock->name}}</td>
                <td>{{$stock->one_supplier->company_name}}</td>
                <td>{{$stock->count}}</td>
                <td>{{number_format($stock->price , 0 , '.' , '.')}} IQD</td>
                <td>{{$stock->expire_date}}</td>
                <td>{{$stock->created_at}}</td>
                <td><span class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#edit{{$stock->id}}">Edit</span>
                    <span class="btn btn-danger btn-sm " data-toggle="modal"
                        data-target="#delete{{$stock->id}}">Delete</span></td>
                <td>@if($stock->is_debt == 1)
                    <span class="btn btn-warning btn-sm  radius-20">Debt !</span>
                    @else
                    No
                    @endif</td>
            </tr>

            <!-- Modal Delete -->
            <div class="modal fade" id="delete{{$stock->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span>Do You Want To Delete {{$stock->name}}</span>

                            <form action="buy/1/{{$stock->id}}" method="POST">
                                @csrf
                                <button class="btn btn-danger w-100 mt-4 radius-20">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
            <div class="modal fade" id="edit{{$stock->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="buy/2/{{$stock->id}}" method="POST">
                                @csrf
                                <div class="row m-2 justify-content-center">
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Barcode Stock</label>
                                        <input name="id" type="text" placeholder="Barcode Stock"
                                            class="form-control radius-20" value="{{$stock->id}}" required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Name Stock</label>
                                        <input name="name" type="text" placeholder="Name Supplier"
                                            class="form-control radius-20" value="{{$stock->name}}" required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Supplier</label>
                                        <select name="supplier_id" class="form-control radius-20" required>
                                            <option value="{{$stock->supplier_id}}">
                                                {{$stock->one_supplier->company_name}}</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Count Stock</label>
                                        <input name="count" type="text" placeholder="Count"
                                            class="form-control radius-20" value="{{$stock->count}}" required>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Price</label>
                                        <input name="price" type="text" placeholder="Price" value="{{$stock->price}}"
                                            class="form-control radius-20" required>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Expire</label>
                                        <input name="expire_date" type="date" class="form-control radius-20"
                                            value="{{$stock->expire_date}}" required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">is Debt?</label>
                                        <select name="is_debt" class="form-control radius-20" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Type</label>
                                        <select name="type" class="form-control radius-20" required>
                                            <option value="0">Barcode</option>
                                            <option value="1">Qrcode</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary radius-20 mt-3 w-25">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<!-- ............................................  end (stocks) ............................................ -->

<!-- ............................................  supplier ............................................ -->
@if(Request::segment(1) == 'supplier')
<div class=" table table-hover table-responsive-sm">
    <table id="data-table" class="table">
        <thead>
            <tr class="text-center">
                <th>Name </th>
                <th>Email </th>
                <th>Address </th>
                <th>Phonenumber </th>
                <th>Action </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($supplier as $sup)
            <tr class="text-center ml-8">
                <td>{{$sup->company_name}}</td>
                <td>{{$sup->email}}</td>
                <td>{{$sup->address}}</td>
                <td>{{$sup->phonenumber}}</td>
                <td><span class="btn btn-primary btn-sm position-absolute right-8" data-toggle="modal"
                        data-target="#edit{{$sup->id}}">Edit</span>
                    <span class="btn btn-danger btn-sm position-absolute" data-toggle="modal"
                        data-target="#delete{{$sup->id}}">Delete</span></td>
            </tr>
            <!-- Modal Delete -->
            <div class="modal fade" id="delete{{$sup->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span>Do You Want To Delete {{$sup->company_name}}</span>

                            <form action="supplier/1/{{$sup->id}}" method="POST">
                                @csrf
                                <button class="btn btn-danger w-100 mt-4 radius-20">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div111 class="modal fade" id="edit{{$sup->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="supplier/2/{{$sup->id}}" method="POST">
                                @csrf
                                <div class="row m-2 justify-content-center">

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Name Supplier</label>
                                        <input name="name" type="text" placeholder="Name Supplier"
                                            class="form-control radius-20" value="{{$sup->company_name}}" required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Email Supplier</label>
                                        <input name="email" type="text" placeholder="Email Supplier"
                                            class="form-control radius-20" value="{{$sup->email}}" required>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Address Supplier</label>
                                        <input name="address" type="text" placeholder="Address Supplier"
                                            class="form-control radius-20" value="{{$sup->address}}" required>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Phonenumber Supplier</label>
                                        <input name="phonenumber" type="number" placeholder="Phonenumber Supplier"
                                            value="{{$sup->phonenumber}}" class="form-control radius-20" required>
                                    </div>
                                </div>
                                <button class="btn btn-primary radius-20 mt-3 w-25">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div111>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<!-- ............................................  end supplier ............................................ -->



<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{asset('/assets/js/bootstrap-table.min.js')}}"></script>

<script type="text/javascript">
    var $table = $('#data-table')

    $(function () {
        $table.bootstrapTable({
            classes: 'table table-hover bg-white table-striped radius-20',
            toolbar: 'toolbar',

            search: true,
            showRefresh: true,
            showToggle: true,
            showColumns: true,
            pagination: true,
            striped: true,
            sortable: true,
            pageSize: 8,
            pageList: [8, 10, 25, 50, 100],
        })
    })

</script>
