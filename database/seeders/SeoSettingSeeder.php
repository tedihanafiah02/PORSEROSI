<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'PORSEROSI', 'group' => 'general', 'label' => 'Nama Situs', 'type' => 'text'],
            ['key' => 'site_title', 'value' => 'PORSEROSI - Persatuan Olahraga Sepatu Roda Seluruh Indonesia', 'group' => 'general', 'label' => 'Judul Default Situs', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'Website resmi PORSEROSI (Persatuan Olahraga Sepatu Roda Seluruh Indonesia). Organisasi induk olahraga sepatu roda, skateboard, dan scooter Indonesia.', 'group' => 'general', 'label' => 'Deskripsi Default Situs', 'type' => 'textarea'],
            ['key' => 'site_keywords', 'value' => 'PORSEROSI, Persatuan Olahraga Sepatu Roda Seluruh Indonesia, sepatu roda, skateboard, inline skate, roller sports, scooter, atlet sepatu roda Indonesia, kejuaraan sepatu roda Indonesia', 'group' => 'general', 'label' => 'Keywords Default (pisahkan dengan koma)', 'type' => 'textarea'],
            ['key' => 'og_image', 'value' => null, 'group' => 'general', 'label' => 'OG Image Default (URL atau path)', 'type' => 'text'],
            ['key' => 'favicon', 'value' => null, 'group' => 'general', 'label' => 'Favicon (URL atau path)', 'type' => 'text'],

            // Organization Schema
            ['key' => 'organization_name', 'value' => 'PORSEROSI', 'group' => 'schema', 'label' => 'Nama Organisasi', 'type' => 'text'],
            ['key' => 'organization_legal_name', 'value' => 'Persatuan Olahraga Sepatu Roda Seluruh Indonesia', 'group' => 'schema', 'label' => 'Nama Legal Organisasi', 'type' => 'text'],
            ['key' => 'organization_founding_year', 'value' => null, 'group' => 'schema', 'label' => 'Tahun Berdiri', 'type' => 'text'],
            ['key' => 'organization_logo', 'value' => null, 'group' => 'schema', 'label' => 'Logo Organisasi (URL)', 'type' => 'text'],
            ['key' => 'organization_email', 'value' => null, 'group' => 'schema', 'label' => 'Email Organisasi', 'type' => 'text'],
            ['key' => 'organization_phone', 'value' => null, 'group' => 'schema', 'label' => 'Telepon/WhatsApp', 'type' => 'text'],
            ['key' => 'organization_address', 'value' => null, 'group' => 'schema', 'label' => 'Alamat Kantor', 'type' => 'textarea'],

            // Social Media
            ['key' => 'social_whatsapp', 'value' => null, 'group' => 'social', 'label' => 'Nomor WhatsApp', 'type' => 'text'],
            ['key' => 'social_email', 'value' => null, 'group' => 'social', 'label' => 'Email', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => null, 'group' => 'social', 'label' => 'URL Instagram', 'type' => 'text'],
            ['key' => 'social_facebook', 'value' => null, 'group' => 'social', 'label' => 'URL Facebook', 'type' => 'text'],
            ['key' => 'social_youtube', 'value' => null, 'group' => 'social', 'label' => 'URL YouTube', 'type' => 'text'],
            ['key' => 'social_twitter', 'value' => null, 'group' => 'social', 'label' => 'URL/Handle Twitter', 'type' => 'text'],
            ['key' => 'social_tiktok', 'value' => null, 'group' => 'social', 'label' => 'URL TikTok', 'type' => 'text'],

            // Analytics
            ['key' => 'google_verification', 'value' => null, 'group' => 'analytics', 'label' => 'Google Search Console Verification Code', 'type' => 'text'],
            ['key' => 'google_analytics_id', 'value' => null, 'group' => 'analytics', 'label' => 'Google Analytics ID (GA4, contoh: G-XXXXXXXXXX)', 'type' => 'text'],
            ['key' => 'gtm_id', 'value' => null, 'group' => 'analytics', 'label' => 'Google Tag Manager ID (contoh: GTM-XXXXXXX)', 'type' => 'text'],
            ['key' => 'bing_verification', 'value' => null, 'group' => 'analytics', 'label' => 'Bing Webmaster Verification Code', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SeoSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
