@extends('layouts.app')

@section('content')
    <div class="body-ntt">
        <div class="containers">
            <div class="block hidden-xs">
                <div class="block-header">
                    <div class="header-title" id="ntt-receive-info-header-pc">
                        <h2 style="color: #af0000;">DONATE | ĐỂ ỦNG HỘ SEVER CÀNG PHÁT TRIỂN</h2>
                        <h4>Thông tin người nhận</h4>
                    </div>
                </div>
                @include('flash::message')
                <div class="block-content">
                    <div class="ntt-receive-info">
                        <div class="tab-content ntt-receive-content col-65">
                            <div id="momo" class="tab-pane active">
                                <ul>
                                    <li>Tài khoản: <strong>0378435791 (Đỗ Hằng Nga)</strong> &nbsp; <a class="0378435791"
                                            onclick="copyTK('ntt-receive-info-header-pc', '0964918575');"
                                            style="background-color: #00a9ff;text-align: center;color: #fff;padding: 3px 10px;border-radius: 10px;">Copy</a>
                                    </li>
                                    <li>Số tiền: (số tiền mà bạn muốn donate)</li>
                                    <li>Nội dung: <strong class="cuphap">ktts-{{ Auth::user()->name}}</strong></li>
                                </ul>
                            </div>
                        </div>

                        <ul class="nav nav-pills flex-column ntt-receive-tabs col-35" role="tablist">
                            <li class="nav-item active" onclick="openBank(event, 'momo')">
                                <a aria-controls="momo" role="tab" data-toggle="tab" aria-expanded="true">
                                    <img src="frontend/img/momo.png" class="img-responsive"> <span>Momo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="block mt-30 mb-30">
                <div class="block-header" id="ntt-receive-info-header">
                    <div class="header-title">
                        <h4>Thông tin chuyển tiền</h4>
                    </div>
                </div>
                <div class="block-content">
                    <div class="ntt-receive-info">
                        <div class="ntt-receive-content col-65">
{{--                            <div class="form-group">--}}
{{--                                <label>Số điện thoại liên hệ (<font color="red">*</font>)</label>--}}
{{--                                <input type="tel" name="player_phone" placeholder="Nhập Số điện thoại" class="form-control"--}}
{{--                                    value="" onkeyup="user_update_cuphap(this)" autocomplete="none">--}}
{{--                            </div>--}}
                            <div class="message error hide" style="color:red; margin-bottom:15px;" id="cuphap-msg-error">
                            </div>

                            <div class="form-group">
                                <label>Nội dung chuyển khoản</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cuphapck_ntt_game" readonly=""
                                        value="ktts-{{$username}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button"
                                            onclick="copy_cuphap_ck('ntt-receive-info-header')"
                                            id="copy_btn_ck">Copy</button>
                                    </span>
                                </div>
                            </div>
                            <div id="popup-warning">
                                <div class="alert alert-warning">
                                    <p></p>
                                    <p><strong><span style="font-size: 11pt;">Hạn mức nạp tối thiểu: <span
                                                    style="color: #771b1b;">10,000 VNĐ</span></span></strong></p>
                                    <p></p>
                                </div>
                            </div>

                            <!-- visible xs -->
                            <div class="form-group visible-xs">
                                <button type="button" onclick="modal()" class="btn btn-primary btn-block btn-lg"
                                    data-target="#modal_ntt_confirm" data-toggle="modal" id="show_payment_btn">Thanh
                                    toán</button>
                            </div>
                        </div>
                        <div class="ntt-receive-qrcode col-35 hidden-xs">
                            <p style="margin-top:0">Hoặc quét QRCODE MOMO</p>
                            <p>
                            </p>
                            <div class="ntt-qrcode" id="ntt-qrcode"><img
                                    width="200px"
                                    src="./frontend/img/qrcode.png"
                                    class="img-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal modal_bottom" id="modal_ntt_confirm" style="text-align: center; padding-top: 20%;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thông tin chuyển tiền</h4>
                            <button type="button" onclick=Close() class="close"  data-dismiss="modal" aria-label="Close">Quay lại</button>
                        </div>
                        <div class="modal-body">

                            <div id="show_package_info"></div>

                            <div class="popup-transfer">
                                <ul class="nav nav-tabs" role="tablist">
{{--                                    <li role="presentation" class="nav-item active" onclick="openBank(event, 'bank_mob')">--}}
{{--                                        <a href="#bank_mob" aria-controls="bank" role="tab" data-toggle="tab">--}}
{{--                                            <img src="frontend/img/popup_bank.png" class="img-responsive"> <span>Ngân hàng</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                    <li role="presentation" class="nav-item active" onclick="openBank(event, 'momo_mob')">
                                        <a href="#momo_mob" aria-controls="momo" role="tab" data-toggle="tab">
                                            <img src="frontend/img/momo.png" class="img-responsive"> <span>Momo</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
{{--                                    <div id="bank_mob" class="tab-pane active">--}}
{{--                                        <div><strong>VP BANK - Ngân Hàng TMCP Việt Nam Thịnh Vượng</strong></div>--}}
{{--                                        <ul>--}}
{{--                                            <li>Vui lòng chọn hình thức: <strong>Ck nhanh 24/7</strong></li>--}}
{{--                                            <li>Tên chủ tài khoản: <strong>GAMOTA CORP</strong></li>--}}
{{--                                            <li>Số tài khoản: <strong>206402668</strong> &nbsp; <a class="206402668"--}}
{{--                                                    onclick="copyTK('modal_ntt_confirm', '206402668');"--}}
{{--                                                    style="background-color: #00a9ff;text-align: center;color: #fff;padding: 3px 10px;border-radius: 10px;">Copy</a>--}}
{{--                                            </li>--}}
{{--                                            <li>Chi nhánh: <strong>BA ĐÌNH - Hà Nội</strong></li>--}}
{{--                                            <li>Nội dung: <strong class="cuphap"> annguyen323010</strong></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
                                    <div id="momo_mob" class="tab-pane active">
                                        <ul>
                                            <li>Tài khoản: <strong>0378435791 (Đỗ Hằng Nga)</strong> &nbsp; <a
                                                    class="0378435791" onclick="copyTK('modal_ntt_confirm', '0378435791');"
                                                    style="background-color: #00a9ff;text-align: center;color: #fff;padding: 3px 10px;border-radius: 10px;">Copy</a>
                                            </li>
                                            <li>Nội dung: <strong class="cuphap">ktts-{{ Auth::user()->name}}</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="close" class="btn btn-primary btn-radius-none"
                                onclick="ntt_confirm_payment('modal_ntt_confirm')">COPY NỘI DUNG THANH TOÁN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function openBank(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-pane");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("nav-item");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    function modal() {
        document.getElementById('modal_ntt_confirm').style.display = "block";
    }
    function Close() {
        document.getElementById('modal_ntt_confirm').style.display = "none";
    }
    function copyTK(popup_modal, tk) {
        var model_body = document.getElementById(popup_modal);
        var tempInput = document.createElement("input");
        tempInput.value = tk;
        model_body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        model_body.removeChild(tempInput);

        $('.' + tk).text('Copied');
    }
    function copy_cuphap_ck(ele) {
		var model_body = document.getElementById(ele);
	    var tempInput = document.createElement("input");
	    tempInput.value = $('#cuphapck_ntt_game').val();
	    model_body.appendChild(tempInput);
	    tempInput.select();
	    document.execCommand("copy");
	    model_body.removeChild(tempInput);

		$('#copy_btn_ck').text('Copied');
	}
    function ntt_confirm_payment(ele) {
		copy_cuphap_ck(ele);
		document.getElementById('modal_ntt_confirm').style.display = "none";
	}
</script>
