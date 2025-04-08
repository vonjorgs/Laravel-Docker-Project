<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ad;
use Purifier;

class AdController extends Controller
{
    public function refreshData()
    {
        $response = Http::get('https://api.kypi.io/feed/v1.2/ads?api_key=f1503763-57dd-4939-84f4-1915abc10a04');
        
        if ($response->successful()) {
            
            $data = $response->json();
            $ads = $data['ads'];




            foreach($ads as $adData) {

                // dd($adData['payout_currency']);

                $cleanDescription = Purifier::clean($adData['description'] ?? '', [
                    'HTML.Allowed' => 'ul,ol,li,strong,em,b,i,p,br,span',
                ]); //clean description from api ad description - disallow script tagd

                Ad::updateOrCreate(
                    ['external_id' => $adData['id']],
                    [
                        'name' => $adData['name'] ?? '',
                        'description' => $cleanDescription,
                        'kpi' => $adData['kpi'] ?? '',
                        'price' => $adData['payout'] ?? null,
                        'payout_currency' => $adData['payout_currency'] ?? null,
                        'creatives_url' => $adData['creatives_url'] ?? '',
                        'click_url' => $adData['click_url'] ?? '',
                        'preview_url' => $adData['preview_url'] ?? '',
                    ]
                );
            }

            return redirect()->back()->with('success', 'Data refreshed Successfully!');
        } else{
            return redirect()->back()->with('error', 'Failed to fetch from API');
        }
    }

    public function index()
    {
        $ads = Ad::paginate(5);
        return view('ads.index', compact('ads'));
    }
}
