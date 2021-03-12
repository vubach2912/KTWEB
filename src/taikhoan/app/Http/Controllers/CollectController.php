<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCollectRequest;
use App\Http\Requests\UpdateCollectRequest;
use App\Models\BNET;
use App\Models\Collect;
use App\Models\Point;
use App\Models\Quest;
use App\Models\Transaction;
use App\Repositories\CollectRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class CollectController extends AppBaseController
{
    /** @var  CollectRepository */
    private $collectRepository;

    public function __construct(CollectRepository $collectRepo)
    {
        $this->collectRepository = $collectRepo;
    }

    /**
     * Display a listing of the Collect.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->name){
            $usename = Auth::user()->name;
        }
        $fgold   = Transaction::where('username',$usename)->where('realm','IMPERIUS')->sum('amount');
        $diamon  = Collect::where('username',$usename)->where('realm','IMPERIUS')->where('item','DIAMON')->sum('amount');
        $point   = Collect::where('username',$usename)->where('realm','IMPERIUS')->where('item','Andariel Soul')->sum('amount');
        $bnet    = BNET::where('acct_username', Auth::User()->name)->first();
        if(!Point::where('acc_name',$usename)->where('realm','IMPERIUS')->exists()){
            $point = 0;
        }

        // Quest
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $todayQuest = Quest::where('username',$usename)->orWhere('created_at', 'like', '%' . $dateNow . '%')->exists();
        if( $todayQuest ){
            $color = "green";
        }else{
            $color = "red";
        }

        // Active
        $accountActive = ($bnet->auth_command_groups > 2);

        //$collects = $this->collectRepository->paginate(20);
        $collects = Collect::where('item', 'Andariel Soul')
            ->selectRaw('*, sum(amount) as sum_amount')
            ->groupBy('username')->orderBy('sum_amount', 'desc')->paginate(20);

        $data = [
            'username'      => $usename,
            'fgold'         => $fgold,
            'diamon'        => $diamon,
            'point'         => $point,
            'color'         => $color,
            'activeAnn'     => $accountActive,
            'collects'      => $collects
        ];

//        return view('home',$data);


        return view('event.index',$data);
    }

    /**
     * Show the form for creating a new Collect.
     *
     * @return Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created Collect in storage.
     *
     * @param CreateCollectRequest $request
     *
     * @return Response
     */
    public function store(CreateCollectRequest $request)
    {
        $input = $request->all();

        $collect = $this->collectRepository->create($input);

        Flash::success('Collect saved successfully.');

        return redirect(route('event.index'));
    }

    /**
     * Display the specified Collect.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('event.index'));
        }

        return view('event.show')->with('collect', $collect);
    }

    /**
     * Show the form for editing the specified Collect.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('event.index'));
        }

        return view('event.edit')->with('collect', $collect);
    }

    /**
     * Update the specified Collect in storage.
     *
     * @param int $id
     * @param UpdateCollectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCollectRequest $request)
    {
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('event.index'));
        }

        $collect = $this->collectRepository->update($request->all(), $id);

        Flash::success('Collect updated successfully.');

        return redirect(route('event.index'));
    }

    /**
     * Remove the specified Collect from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            Flash::error('Collect not found');

            return redirect(route('event.index'));
        }

        $this->collectRepository->delete($id);

        Flash::success('Collect deleted successfully.');

        return redirect(route('event.index'));
    }
}
