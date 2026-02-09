<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show general settings page
     */
    public function general()
    {
        $settings = $this->getSettings();
        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_phone' => 'nullable|string|max:20',
            'site_address' => 'nullable|string',
            'site_description' => 'nullable|string',
            'currency' => 'required|string|max:10',
            'timezone' => 'required|string',
        ]);

        $this->updateSettings($request->only([
            'site_name', 'site_email', 'site_phone', 'site_address', 
            'site_description', 'currency', 'timezone'
        ]));

        return redirect()->route('admin.settings.general')
            ->with('success', 'General settings updated successfully!');
    }

    /**
     * Show shipping settings page
     */
    public function shipping()
    {
        $settings = $this->getSettings();
        return view('admin.settings.shipping', compact('settings'));
    }

    /**
     * Update shipping settings
     */
    public function updateShipping(Request $request)
    {
        $request->validate([
            'shipping_enabled' => 'boolean',
            'free_shipping_threshold' => 'nullable|numeric|min:0',
            'flat_rate_shipping' => 'nullable|numeric|min:0',
            'local_pickup_enabled' => 'boolean',
        ]);

        $this->updateSettings($request->only([
            'shipping_enabled', 'free_shipping_threshold', 
            'flat_rate_shipping', 'local_pickup_enabled'
        ]));

        return redirect()->route('admin.settings.shipping')
            ->with('success', 'Shipping settings updated successfully!');
    }

    /**
     * Show payment settings page
     */
    public function payment()
    {
        $settings = $this->getSettings();
        return view('admin.settings.payment', compact('settings'));
    }

    /**
     * Update payment settings
     */
    public function updatePayment(Request $request)
    {
        $request->validate([
            'cod_enabled' => 'boolean',
            'razorpay_enabled' => 'boolean',
            'razorpay_key' => 'nullable|string',
            'razorpay_secret' => 'nullable|string',
            'stripe_enabled' => 'boolean',
            'stripe_key' => 'nullable|string',
            'stripe_secret' => 'nullable|string',
        ]);

        $this->updateSettings($request->only([
            'cod_enabled', 'razorpay_enabled', 'razorpay_key', 'razorpay_secret',
            'stripe_enabled', 'stripe_key', 'stripe_secret'
        ]));

        return redirect()->route('admin.settings.payment')
            ->with('success', 'Payment settings updated successfully!');
    }

    /**
     * Show SEO settings page
     */
    public function seo()
    {
        $settings = $this->getSettings();
        return view('admin.settings.seo', compact('settings'));
    }

    /**
     * Update SEO settings
     */
    public function updateSeo(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'google_analytics' => 'nullable|string',
            'facebook_pixel' => 'nullable|string',
        ]);

        $this->updateSettings($request->only([
            'meta_title', 'meta_description', 'meta_keywords',
            'google_analytics', 'facebook_pixel'
        ]));

        return redirect()->route('admin.settings.seo')
            ->with('success', 'SEO settings updated successfully!');
    }

    /**
     * Get all settings from file or database
     */
    private function getSettings()
    {
        $settingsFile = storage_path('app/settings.json');
        
        if (file_exists($settingsFile)) {
            return json_decode(file_get_contents($settingsFile), true) ?? [];
        }
        
        return $this->getDefaultSettings();
    }

    /**
     * Update settings in file
     */
    private function updateSettings(array $newSettings)
    {
        $settings = $this->getSettings();
        $settings = array_merge($settings, $newSettings);
        
        $settingsFile = storage_path('app/settings.json');
        file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
    }

    /**
     * Get default settings
     */
    private function getDefaultSettings()
    {
        return [
            'site_name' => 'Printingg Nova',
            'site_email' => 'info@printinggnova.com',
            'site_phone' => '',
            'site_address' => '',
            'site_description' => 'Your one-stop shop for anime merchandise',
            'currency' => 'INR',
            'timezone' => 'Asia/Kolkata',
            'shipping_enabled' => true,
            'free_shipping_threshold' => 500,
            'flat_rate_shipping' => 50,
            'local_pickup_enabled' => false,
            'cod_enabled' => true,
            'razorpay_enabled' => false,
            'razorpay_key' => '',
            'razorpay_secret' => '',
            'stripe_enabled' => false,
            'stripe_key' => '',
            'stripe_secret' => '',
            'meta_title' => 'Printingg Nova - Anime Merchandise Store',
            'meta_description' => 'Shop the best anime merchandise, posters, and collectibles',
            'meta_keywords' => 'anime, merchandise, posters, collectibles',
            'google_analytics' => '',
            'facebook_pixel' => '',
        ];
    }
}
