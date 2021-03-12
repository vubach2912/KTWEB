<?php

namespace App\Http\Controllers\Diablo2;

use Illuminate\Support\Facades\Auth;

use App\Repositories\KillRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateKillRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flash;
use Response;

class KillController extends Controller
{

    private $killRepository;

    public function __construct(KillRepository $kilRepo)
    {
        $this->killRepository = $kilRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->name){
            $username = Auth::user()->name;
        }

        $kill = $this->killRepository;
        if (!empty($request->username))
            $data['kills'] = $kill->find(["username" => $request->username]);
        $data['kills'] = $kill->getAllFindName($username);

        return view('kill.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect(route('kill.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $kills = $this->killRepository->find($id);
        // if (empty($kills)) {
        //     Flash::error('kills not found');

        //     return redirect(route('kill.index'));
        // }

        // return view('kill.show')->with('kills', $kills);
        //
        return redirect(route('kill.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $kills = $this->killRepository->find($id);
        // if (empty($kills)) {
        //     Flash::error('kills not found');

        //     return redirect(route('kill.index'));
        // }

        // return view('kill.edit')->with('kills', $kills);

        return redirect(route('kill.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        // $kills = $this->killRepository->find($id);

        // if (empty($kills)) {
        //     Flash::error('Transaction not found');

        //     return redirect(route('kill.index'));
        // }

        // $kills = $this->killRepository->update($request->all(), $id);

        // Flash::success('Transaction updated successfully.');

        // return redirect(route('kill.index'));
        return redirect(route('kill.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $kills = $this->killRepository->find($id);
        
        // if (empty($kills)) {
        //     Flash::error('kills not found');

        //     return redirect(route('kill.index'));
        // }

        // $this->killRepository->delete($id);
       
        // Flash::success('kills deleted successfully.');

        // return redirect(route('kill.index'));

        return redirect(route('kill.index'));
    }
}
