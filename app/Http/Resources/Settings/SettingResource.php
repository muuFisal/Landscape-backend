<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $theme = strtolower((string) $request->get('theme', 'light'));
        $lightLogo = $this->light_logo ?: $this->logo;
        $darkLogo = $this->dark_logo ?: $this->logo;

        $metaKeyTranslations = $this->getTranslations('meta_key');
        $metaDescTranslations = $this->getTranslations('meta_desc');

        $metaKey = collect([
            $metaKeyTranslations['ar'] ?? null,
            $metaKeyTranslations['en'] ?? null,
        ])->filter()->implode(' , ');

        $metaDesc = collect([
            $metaDescTranslations['ar'] ?? null,
            $metaDescTranslations['en'] ?? null,
        ])->filter()->implode(' , ');

        return [
            'name' => $this->site_name,
            'title' => $this->site_title,
            'desc' => $this->site_desc,
            'address' => $this->site_address,

            'meta_key' => $metaKey,
            'meta_desc' => $metaDesc,

            'phone' => $this->site_phone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->site_email,
            'support' => $this->email_support,
            'socials' => [
                'facebook' => $this->facebook,
                'x' => $this->x_url,
                'youtube' => $this->youtube,
                'instagram' => $this->instagram,
                'tiktok' => $this->tiktok,
                'linkedin' => $this->linkedin,
            ],
            'media' => [
                'logo' => asset($this->logo),
                'light_logo' => asset($lightLogo),
                'dark_logo' => asset($darkLogo),
                'selected_logo' => asset($theme === 'dark' ? $darkLogo : $lightLogo),
                'favicon' => asset($this->favicon),
            ],
            'copyright' => $this->site_copyright,
            'promotion' => $this->promotion_url,
        ];
    }
}
