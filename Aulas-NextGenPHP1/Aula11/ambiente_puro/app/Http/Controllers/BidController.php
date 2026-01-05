<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Services\Bid\BidService;

class BidController extends Controller
{
    protected InputInterface $input;

    protected PresenterInterface $output;

    protected BidService $bidService;

    public function getBids(Request $request)
    {
        // stdClass
        $bidDTO = $this->input->setRequest($request, new BidDTO());

        // Mapper | Hydrator
        $bids = $this->bidService->getBids($bidDTO);

        return $this->presenter->sendFormatterResponse($bids);
    }
}
