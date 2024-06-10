<?php
namespace Database\Seeders;
 
use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['setting_key' => 'website_name', 'setting_value' => config('app.name'),'display_title'=>'Website Name','setting_type'=>'text'],
            ['setting_key' => 'website_title', 'setting_value' => config('app.name'),'display_title'=>'Website Title','setting_type'=>'text'],
            ['setting_key' => 'website_logo', 'setting_value' => '','display_title'=>'Website Logo','setting_type'=>'image'],
            ['setting_key' => 'website_favicon_icon', 'setting_value' => '','display_title'=>'Website Favicon Icon','setting_type'=>'image'],
            ['setting_key' => 'copyright_text', 'setting_value' => '© Copyright '.config('app.name').'. All Rights Reserved','display_title'=>'Copyright Text','setting_type'=>'text'],
            ['setting_key' => 'facebook_url', 'setting_value' => 'https://facebook.com','display_title'=>'Facebook Url','setting_type'=>'text'],
            ['setting_key' => 'twitter_url', 'setting_value' => 'https://twitter.com','display_title'=>'Twitter Url','setting_type'=>'text'],
            ['setting_key' => 'instagram_url', 'setting_value' => 'https://instagram.com','display_title'=>'Instagram Url','setting_type'=>'text'],
            ['setting_key' => 'google_url', 'setting_value' => 'https://google.com','display_title'=>'Google Url','setting_type'=>'text'],
            ['setting_key' => 'company_address', 'setting_value' => '111, fourth avenue, city square mall','display_title'=>'Comapny Address','setting_type'=>'textarea'],
            ['setting_key' => 'company_contact_no', 'setting_value' => '','display_title'=>'Company Contact No','setting_type'=>'text'],
            ['setting_key' => 'company_contact_email', 'setting_value' => 'contact@example.com','display_title'=>'Company Contact Email','setting_type'=>'text'],
            ['setting_key' => 'email_notification', 'setting_value' => '1','display_title'=>'Email Notification','setting_type'=>'boolean'],
            ['setting_key' => 'sms_notification', 'setting_value' => '0','display_title'=>'SMS Notification','setting_type'=>'boolean'],
            ['setting_key' => 'push_notification', 'setting_value' => '0','display_title'=>'Push Notification','setting_type'=>'boolean'],
            ['setting_key' => 'smtp_username', 'setting_value' => '','display_title'=>'SMTP Username','setting_type'=>'text'],
            ['setting_key' => 'smtp_password', 'setting_value' => '','display_title'=>'SMTP Password','setting_type'=>'text'],
            ['setting_key' => 'smtp_from_email', 'setting_value' => '','display_title'=>'SMTP From Email','setting_type'=>'text'],
            ['setting_key' => 'smtp_from_name', 'setting_value' => '','display_title'=>'SMTP From Name','setting_type'=>'text'],
        ];

        foreach ($settings as $setting) {
            GeneralSetting::updateOrCreate(['setting_key' => $setting['setting_key']], $setting);
        }
        $settings = [
            ['setting_key' => 'partner_default_logo', 'setting_value' => '','display_title'=>'Partner Default Logo','setting_type'=>'image','is_module_setting'=>'1','module'=>'Partner'],
        ];
        foreach ($settings as $setting) {
            GeneralSetting::updateOrCreate(['setting_key' => $setting['setting_key']], $setting);
        }
    }
}
