<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTradeRequest;
use App\Http\Requests\UpdateTradeRequest;
use App\Repositories\TradeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Image;
use Response;
use Symfony\Component\Console\Input\Input;

class TradeController extends AppBaseController
{
    /** @var  TradeRepository */
    private $tradeRepository;

    public function __construct(TradeRepository $tradeRepo)
    {
        $this->tradeRepository = $tradeRepo;
    }

    /**
     * Display a listing of the Trade.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trades = $this->tradeRepository->paginate(20);

        return view('trades.index')
            ->with('trades', $trades);
    }

    /**
     * Show the form for creating a new Trade.
     *
     * @return Response
     */
    public function create()
    {
        return view('trades.create');
    }

    /**
     * Store a newly created Trade in storage.
     *
     * @param CreateTradeRequest $request
     *
     * @return Response
     */
    public function store(CreateTradeRequest $request)
    {
        $input = $request->all();

        $trade = $this->tradeRepository->create($input);

        Flash::success('Trade saved successfully.');

        return redirect(route('trades.index'));
    }

    /**
     * Display the specified Trade.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trade = $this->tradeRepository->find($id);

        if (empty($trade)) {
            Flash::error('Trade not found');

            return redirect(route('trades.index'));
        }

        return view('trades.show')->with('trade', $trade);
    }

    /**
     * Show the form for editing the specified Trade.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trade = $this->tradeRepository->find($id);

        if (empty($trade)) {
            Flash::error('Trade not found');

            return redirect(route('trades.index'));
        }

        return view('trades.edit')->with('trade', $trade);
    }

    /**
     * Update the specified Trade in storage.
     *
     * @param int $id
     * @param UpdateTradeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradeRequest $request)
    {
        $trade = $this->tradeRepository->find($id);

        if (empty($trade)) {
            Flash::error('Trade not found');
            return redirect(route('trades.index'));
        }
        $trade = $this->tradeRepository->update($request->all(), $id);

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
//            $img->resize(300, 120, function ($constraint) {
//                $constraint->aspectRatio();
//            });
            $img->stream(); // <-- Key point
            //dd();
            Storage::disk('local')->put('public/images/1/smalls'.'/'.$fileName, $img, 'public');

            $trade->image = 'storage/images/1/smalls'.'/'.$fileName;
            $trade->save();
        }

        Flash::success('Trade updated successfully.');
        return redirect(route('trades.index'));
    }

    /**
     * Remove the specified Trade from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trade = $this->tradeRepository->find($id);

        if (empty($trade)) {
            Flash::error('Trade not found');

            return redirect(route('trades.index'));
        }

        $this->tradeRepository->delete($id);

        Flash::success('Trade deleted successfully.');

        return redirect(route('trades.index'));
    }
}
