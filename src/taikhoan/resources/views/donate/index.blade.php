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
                            <div id="card" class="tab-pane">
                                CHƯA HOÀN THIỆN
                            </div>
                            <div id="bank" class="tab-pane">

                                <div><strong>TECHCOMBANK</strong></div>
                                <ul>
                                    <li>Vui lòng chọn hình thức: <strong>Ck nhanh 24/7</strong></li>
                                    <li>Tên chủ tài khoản: <strong>{{ env('DONATE_CK_TECH_NAME', 'Phạm Việt An')}}</strong></li>
                                    <li>Số tài khoản: <strong>{{ env('DONATE_CK_TECH_NUMBER', '19024143666686')}}</strong></li>
                                    <li>Nội dung: <strong class="cuphap"> {{ env('DONATE_STRING', 'hk')}} {{ Auth::user()->name}}</strong></li>
                                </ul>

                                <div><strong>VIETCOMBANK</strong></div>
                                <ul>
                                    <li>Vui lòng chọn hình thức: <strong>Ck nhanh 24/7</strong></li>
                                    <li>Tên chủ tài khoản: <strong>{{ env('DONATE_CK_VCB_NAME', 'Phạm Việt An')}}</strong></li>
                                    <li>Số tài khoản: <strong>{{ env('DONATE_CK_VCB_NUMBER', '0541000271925')}}</strong></li>
                                    <li>Nội dung: <strong class="cuphap"> {{ env('DONATE_STRING', 'hk')}} {{ Auth::user()->name}}</strong></li>
                                </ul>

                            </div>
                            <div id="momo" class="tab-pane active">
                                <ul>
                                    <li>Tài khoản: <strong>{{ env('MOMO_NUMBER', '0378435791')}} ({{ env('MOMO_NAME', 'Đỗ Hằng Nga')}})
                                        </strong> &nbsp; <a class="{{ env('MOMO_NUMBER', '0378435791')}}"
                                            onclick="copyTK('ntt-receive-info-header-pc', '{{ env('MOMO_NUMBER', '0378435791')}}');"
                                            style="background-color: #00a9ff;text-align: center;color: #fff;padding: 3px 10px;border-radius: 10px;">Copy</a>
                                    </li>
                                    <li>Số tiền: (số tiền mà bạn muốn donate)</li>
                                    <li>Nội dung: <strong class="cuphap">{{ env('DONATE_STRING', 'hk')}} {{ Auth::user()->name}}</strong></li>
                                </ul>
                            </div>
                        </div>

                        <ul class="nav nav-pills flex-column ntt-receive-tabs col-35" role="tablist">
                            <li class="nav-item active" onclick="openBank(event, 'momo')">
                                <a aria-controls="momo" role="tab" data-toggle="tab" aria-expanded="true">
                                    <img src="/taikhoan/frontend/img/momo.png" class="img-responsive"> <span>Momo</span>
                                </a>
                            </li>
                            <li class="nav-item" onclick="openBank(event, 'bank')">
                                <a href="#bank" aria-controls="bank" role="tab" data-toggle="tab">
                                    <img src="/taikhoan/frontend/img/popup_bank.png" class="img-responsive"> <span>Ngân hàng</span>
                                </a>
                            </li>
                            <li class="nav-item" onclick="openBank(event, 'card')">
                                <a href="#card" aria-controls="bank" role="tab" data-toggle="tab">
                                    <span>Thẻ cào</span>
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
                            <div class="message error hide" style="color:red; margin-bottom:15px;" id="cuphap-msg-error">
                            </div>

                            <div class="form-group">
                                <label>Nội dung chuyển khoản</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cuphapck_ntt_game" readonly=""
                                        value="{{ env('DONATE_STRING', 'hk')}} {{$username}}">
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
                                    <li role="presentation" class="nav-item" onclick="openBank(event, 'bank_mob')">
                                        <a href="#bank_mob" aria-controls="bank" role="tab" data-toggle="tab">
                                            <img src="/taikhoan/frontend/img/popup_bank.png" class="img-responsive"> <span>Ngân hàng</span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="nav-item active" onclick="openBank(event, 'momo_mob')">
                                        <a href="#momo_mob" aria-controls="momo" role="tab" data-toggle="tab">
                                            <img src="/taikhoan/frontend/img/momo.png" class="img-responsive"> <span>Momo</span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="nav-item" onclick="openBank(event, 'card_mob')">
                                        <a href="#card_mob" aria-controls="card" role="tab" data-toggle="tab">
                                            <span>Thẻ Cào</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="card_mob" class="tab-pane">
                                        CHƯA HOÀN THIỆN
                                    </div>
                                    <div id="bank_mob" class="tab-pane">

                                        <div><strong>TECHCOMBANK</strong></div>
                                        <ul>
                                            <li>Vui lòng chọn hình thức: <strong>Ck nhanh 24/7</strong></li>
                                            <li>Tên chủ tài khoản: <strong>{{ env('DONATE_CK_TECH_NAME', 'Phạm Việt An')}}</strong></li>
                                            <li>Số tài khoản: <strong>{{ env('DONATE_CK_TECH_NUMBER', '19024143666686')}}</strong></li>
                                            <li>Nội dung: <strong class="cuphap"> {{ env('DONATE_STRING', 'hk')}} {{ Auth::user()->name}}</strong></li>
                                        </ul>

                                        <div><strong>VIETCOMBANK</strong></div>
                                        <ul>
                                            <li>Vui lòng chọn hình thức: <strong>Ck nhanh 24/7</strong></li>
                                            <li>Tên chủ tài khoản: <strong>{{ env('DONATE_CK_VCB_NAME', 'Phạm Việt An')}}</strong></li>
                                            <li>Số tài khoản: <strong>{{ env('DONATE_CK_VCB_NUMBER', '0541000271925')}}</strong></li>
                                            <li>Nội dung: <strong class="cuphap"> {{ env('DONATE_STRING', 'hk')}} {{ Auth::user()->name}}</strong></li>
                                        </ul>

                                    </div>
                                    <div id="momo_mob" class="tab-pane active">
                                        <ul>
                                            <li>Tài khoản: <strong>{{ env('MOMO_NUMBER', '0378435791')}} ({{ env('MOMO_NAME', 'Đỗ Hằng Nga')}})</strong> &nbsp; <a
                                                    class="{{ env('MOMO_NUMBER', '0378435791')}}"
                                                    onclick="copyTK('modal_ntt_confirm', '{{ env('MOMO_NUMBER', '0378435791')}}');"
                                                    style="background-color: #00a9ff;text-align: center;color: #fff;padding: 3px 10px;border-radius: 10px;">Copy</a>
                                            </li>
                                            <li>Nội dung: <strong class="cuphap">{{ env('DONATE_STRING', 'hk')}} {{ Auth::user()->name}}</strong></li>
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
