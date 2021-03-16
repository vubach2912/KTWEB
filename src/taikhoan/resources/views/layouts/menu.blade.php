<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="home"><i class="fa fa-home"></i><span>Cài đặt</span></a>
</li>
<li class="{{ Request::is('donate*') ? 'active' : '' }}">
    <a href="donate"><i class="fa fa-usd"></i><span>Nạp Đồng</span></a>
</li>
{{--<li class="{{ Request::is('transactions*') ? 'active' : '' }}">--}}
{{--    <a href="{{ route('transactions.index') }}"><i class="fa fa-edit"></i><span>Lich sử giao dịch</span></a>--}}
{{--</li>--}}
