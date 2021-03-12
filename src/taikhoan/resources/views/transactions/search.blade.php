<div class="search-from">
    <form action="{{route('transactions.index')}}">
        <div class="box box-info">
            <div class="box-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5 style="margin-right:30px;margin-left:30px;margin-top: 0px;" class="pull-left">Số dư còn lại :<span class = "label label-default" style="font-size: 11px;background-color: #f39c12;color: white;">{{$surplus}}</span></h5>
                        <h5 style="margin-top: 15px;">Tổng số dư đã DONATE :<span class = "label label-default" style="font-size: 11px;background-color: #f39c12;color: white;">{{$sumSurplus}}</span></h5>
                    </div>
                </div>
                <!-- <div class="col-md-1 pull-right">
                    <div class="form-group" style="margin-top: 50px">
                        <button type="submit" class="btn btn-block btn-info">Tìm Kiếm</button>
                    </div>
                </div> -->
            </div>
        </div>
    </form>
</div>
<style>
    .form-control {
        height: 33px;
    }
</style>
