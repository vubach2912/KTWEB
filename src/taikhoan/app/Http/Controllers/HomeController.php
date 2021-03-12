<?php

namespace App\Http\Controllers;

use App\Helpers\BNETPost as BNETPostAlias;
use App\Helpers\PvPGNHash as PvPGNHashAlias;
use App\Models\BNET;
use App\Models\JXAccount;
use App\Models\PVPGNGiftcheck;
use App\Repositories\BNETRepository as BNETRepositoryAlias;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Collect;
use App\Models\Point;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use App\Services\SocialAccountService;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * @var BNETPostAlias
     */
    private $BNETPost;

    /**
     * @var BNETRepositoryAlias
     */
    private $BNETRepository;

    /**
     * @var PvPGNHashAlias
     */
    private $pvpgnHash;

    /**
     * Create a new controller instance.
     *
     * @param PvPGNHashAlias $pvpgnHash
     * @param BNETPostAlias $BNETPost
     * @param BNETRepositoryAlias $BNETRepository
     */
    public function __construct(
        PvPGNHashAlias $pvpgnHash,
        BNETPostAlias $BNETPost,
        BNETRepositoryAlias $BNETRepository
    )
    {
        $this->middleware('auth');
        $this->BNETPost = $BNETPost;
        $this->BNETRepository = $BNETRepository;
        $this->pvpgnHash = $pvpgnHash;
    }

    /**
     * Show the application dashboard.
     *
     * @return ApplicationAlias|FactoryAlias|Response|View
     */
    public function index()
    {
        if(Auth::user()->name){
            $usename = Auth::user()->name;
        }

        $data = [
            'username'      => $usename
        ];

        return view('home',$data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function post(Request $request) {
        if(!Auth::check()) return redirect()->to('/');

        if(isset($_POST['settingPassword'])) {
            return $this->postPassword($request);
        }

        if(isset($_POST['activeAnn'])) {
            return $this->activeAnn($request);
        }

        return redirect()->to('/');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    function postPassword(Request $request) {
        $requestData = $request->All();
        $currentPassword = Auth::User()->password;

        if(!Hash::check($requestData['old_password'], $currentPassword)) {
            Flash::error('Mật khẩu hiện tại không đúng.');
            return redirect()->to('home');
        }

        if(!$requestData['newPassword'] == $requestData['cf_password']) {
            Flash::error('Mật khẩu xác nhận sai.');
            return redirect()->to('home');
        }

        $userId     = Auth::User()->id;
        $objUser    = User::find($userId);
        $objUser->password = Hash::make($requestData['newPassword']);

        try {
            $objUser->save();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Flash::error('Hệ thống bị lỗi, xin vui lòng báo cho Admin.');
            return redirect()->to('home');
        }

        $jxAccount = JXAccount::where('email', Auth::User()->email)->first();
        $jxAccount->password_hash = md5($requestData['newPassword']);

        try {
            $jxAccount->save();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Flash::error('Hệ thống bị lỗi, xin vui lòng báo cho Admin.');
            return redirect()->to('home');
        }

        Flash::success('Password saved successfully.');
        return redirect()->to('home');
    }

    public function activeAnn(Request $request) {
        $bnetModel = \App\Models\BNET::where('acct_username', Auth::User()->name)->first();
        if (!$bnetModel) {
            Flash::error('Cannot active /Ann, please contact Administrator');
            return redirect()->to('home');
        }

        $bnetModel->auth_command_groups = 3;
        $bnetModel->timestamps = false;
        $bnetModel->save();

        Flash::success('Kích hoạt tài khoản thành công, vui lòng đợi 24h sau tài khoản của bạn có thể chat /ann');
        return redirect()->to('home');
    }

    public function shareFb(Request $request) {
        $username = Auth::user()->name;

        if (!SocialAccountService::checkSocialAccount(Auth::user()->id)) {
            return json_encode(['status' => '0', 'mess' => 'Cần kết nối tài khoản facebook trước khi share.']);
        }

        $diamon  = Collect::where('username', $username)
                            ->where('realm','S11_AURIEL')
                            ->where('item','DIAMON')
                            ->where('comment', 'BONUS DAILY')
                            ->whereDate('created_at', Carbon::today())
                            ->get();
        if ($diamon->count() > 0) {
            return json_encode(['status' => '0', 'mess' => 'Bạn đã nhận phần quà hôm nay rồi, không thể nhận được nữa.']);
        }

        // Check IP
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        if ($ip) {
            $diamonByIP  = Collect::where('realm','S11_AURIEL')
                ->where('item','DIAMON')
                ->where('comment', 'BONUS DAILY')
                ->whereDate('created_at', Carbon::today())
                ->where('IP', $ip)
                ->get();
            if ($diamonByIP->count() > 0) {
                return json_encode(['status' => '0', 'mess' => 'Bạn đã nhận phần quà hôm nay rồi, không thể nhận được nữa.']);
            }
        }

        $diamonModel = new Collect();
        $diamonModel->realm = 'S11_AURIEL';
        $diamonModel->item = 'DIAMON';
        $diamonModel->comment = 'BONUS DAILY';
        $diamonModel->amount = 100;
        $diamonModel->username = $username;
        $diamonModel->IP = $ip;
        $diamonModel->timestamps = false;
        $diamonModel->save();
        return json_encode(['status' => '1', 'mess' => 'Nhận thưởng thành công, vui lòng vào game check nhé bạn.']);
    }
}
