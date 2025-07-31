<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdCampaign;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdCampaignController extends Controller
{
    public function index()
    {
        $campaigns = AdCampaign::with('creator')
            ->latest()
            ->paginate(15);

        return view('admin.ad-campaigns.index', compact('campaigns'));
    }

    public function create(Request $request)
    {
        $products = Product::where('is_active', true)->get();
        $selectedProducts = [];

        // Si des produits sont pré-sélectionnés via URL
        if ($request->has('products')) {
            $productIds = is_array($request->products) ? $request->products : explode(',', $request->products);
            $selectedProducts = Product::whereIn('id', $productIds)->get();
        }

        return view('admin.ad-campaigns.create', compact('products', 'selectedProducts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'platform' => 'required|in:google_ads,meta_ads,both',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
            'budget' => 'required|numeric|min:1000', // Minimum 1000 FCFA
            'duration_days' => 'required|integer|min:1|max:365',
            'target_audience' => 'nullable|array',
            'ad_copy' => 'nullable|string|max:500',
        ]);

        $campaign = AdCampaign::create([
            'name' => $request->name,
            'platform' => $request->platform,
            'product_ids' => $request->product_ids,
            'budget' => $request->budget,
            'duration_days' => $request->duration_days,
            'target_audience' => $request->target_audience ?? [],
            'ad_copy' => $request->ad_copy,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.ad-campaigns.show', $campaign)
            ->with('success', 'Campagne publicitaire créée avec succès !');
    }

    public function show(AdCampaign $adCampaign)
    {
        $adCampaign->load('creator');
        $products = $adCampaign->products();

        return view('admin.ad-campaigns.show', compact('adCampaign', 'products'));
    }

    public function launch(AdCampaign $adCampaign)
    {
        try {
            // Ici vous intégrerez les APIs Google Ads et Meta
            $results = $this->launchCampaignOnPlatforms($adCampaign);

            $adCampaign->update([
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addDays($adCampaign->duration_days),
                'campaign_id_google' => $results['google_id'] ?? null,
                'campaign_id_meta' => $results['meta_id'] ?? null,
            ]);

            return redirect()
                ->route('admin.ad-campaigns.show', $adCampaign)
                ->with('success', 'Campagne lancée avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur lancement campagne', [
                'campaign_id' => $adCampaign->id,
                'error' => $e->getMessage()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Erreur lors du lancement : ' . $e->getMessage());
        }
    }

    private function launchCampaignOnPlatforms(AdCampaign $campaign)
    {
        $results = [];

        if (in_array($campaign->platform, ['google_ads', 'both'])) {
            $results['google_id'] = $this->launchGoogleAdsCampaign($campaign);
        }

        if (in_array($campaign->platform, ['meta_ads', 'both'])) {
            $results['meta_id'] = $this->launchMetaAdsCampaign($campaign);
        }

        return $results;
    }

    private function launchGoogleAdsCampaign(AdCampaign $campaign)
    {
        // TODO: Intégration avec Google Ads API
        // Pour l'instant, simulation
        Log::info('Lancement campagne Google Ads', ['campaign' => $campaign->name]);
        return 'google_campaign_' . uniqid();
    }

    private function launchMetaAdsCampaign(AdCampaign $campaign)
    {
        // TODO: Intégration avec Meta Marketing API
        // Pour l'instant, simulation
        Log::info('Lancement campagne Meta Ads', ['campaign' => $campaign->name]);
        return 'meta_campaign_' . uniqid();
    }
}
