<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use Translatable;

    //TODO:: To use the site settings, please use the functions of the helper.php file.
    // If you have created new settings, please use the same structure to optimize
    // the number of requests to the database, because this system does not use cache.

    protected $table = 'settings';
    public $timestamps = false;
    protected $guarded = ['id'];


    public $translatedAttributes = ['value'];

    public function getValueAttribute()
    {
        return getTranslateAttributeValue($this, 'value');
    }

    // The result is stored in these variables
    // If you use each function more than once per page, the database will be requested only once.
    static $seoMetas, $socials,
        $footer, $general, $homeSections,
        $financial, $siteBankAccounts, $referral,
        $homeHero, $homeHero2, $homeVideoOrImage,
        $pageBackground, $customCssJs,
        $reportReasons, $notificationTemplates,
        $contactPage, $Error404Page, $navbarLink, $panelSidebar;

    // settings name , Using these keys, values are taken from the settings table
    static $seoMetasName = 'seo_metas';
    static $socialsName = 'socials';
    static $footerName = 'footer';
    static $generalName = 'general';
    static $homeSectionsName = 'home_sections';
    static $financialName = 'financial';
    static $siteBankAccountsName = 'site_bank_accounts';
    static $referralName = 'referral';
    static $homeHeroName = 'home_hero';
    static $homeHeroName2 = 'home_hero2';
    static $homeVideoOrImageName = 'home_video_or_image_box';
    static $pageBackgroundName = 'page_background';
    static $customCssJsName = 'custom_css_js';
    static $reportReasonsName = 'report_reasons';
    static $notificationTemplatesName = 'notifications';
    static $contactPageName = 'contact_us';
    static $Error404PageName = '404';
    static $navbarLinkName = 'navbar_links';
    static $panelSidebarName = 'panel_sidebar';

    //statics
    static $pagesSeoMetas = ['home', 'search', 'categories', 'classes', 'login', 'register', 'contact', 'blog', 'certificate_validation', 'instructors', 'organizations'];
    static $mainSettingSections = ['general', 'financial', 'payment', 'home_hero', 'home_hero2', 'page_background', 'home_video_or_image_box'];
    static $mainSettingPages = ['general', 'financial', 'personalization', 'notifications', 'seo', 'customization', 'other'];

    static $defaultSettingsLocale = 'en'; // Because the settings table uses translation and some settings do not need to be translated, so we save them with a default locale


    static function getSettingsWithDefaultLocal():array
    {
        return [
            self::$seoMetasName,
            self::$socialsName,
            self::$generalName,
            self::$financialName,
            self::$siteBankAccountsName,
            self::$referralName,
            self::$pageBackgroundName,
            self::$homeSectionsName,
            self::$notificationTemplatesName,
            self::$customCssJsName,
            self::$Error404PageName,
            self::$contactPageName,
        ];
    }

    // functions
    static function getSetting(&$static, $name, $key = null)
    {
        if (!isset($static)) {
            $static = cache()->remember('settings.' . $name, 24 * 60 * 60, function () use ($name) {
                return self::where('name', $name)->first();
            });
        }

        $value = [];

        if (!empty($static) and !empty($static->value) and isset($static->value)) {
            $value = json_decode($static->value, true);
        }

        if (!empty($value) and !empty($key)) {
            if (!empty($value[$key])) {
                return $value[$key];
            } else {
                return null;
            }
        }

        if (!empty($key) and (empty($value) or count($value) < 1)) {
            return '';
        }

        return $value;
    }

    /**
     * @param null $page => home, search, categories, login, register, about, contact
     * @return array => [title, description]
     */
    static function getSeoMetas($page = null)
    {
        return self::getSetting(self::$seoMetas, self::$seoMetasName, $page);
    }

    /**
     * @return array [title, image, link]
     */
    static function getSocials()
    {
        return self::getSetting(self::$socials, self::$socialsName);
    }


    /**
     * @return array [title, items => [title, link]]
     */
    static function getFooterColumns()
    {
        return self::getSetting(self::$footer, self::$footerName);
    }


    /**
     * @return array [site_name, site_email, site_language, user_languages, rtl_languages, fav_icon, logo, footer_logo, rtl_layout, home hero1 is active, home hero2 is active, content_translate ]
     */
    static function getGeneralSettings($key = null)
    {
        return self::getSetting(self::$general, self::$generalName, $key);
    }


    /**
     * @param $key
     * @return array|[commission, tax, minimum_payout, currency]
     */
    static function getFinancialSettings($key = null)
    {
        return self::getSetting(self::$financial, self::$financialName, $key);
    }


    /**
     * @param string $section
     * @return array|[title, description, hero_background]
     */
    static function getHomeHeroSettings($section = '1')
    {
        if ($section == "2") {
            return self::getSetting(self::$homeHero2, self::$homeHeroName2);
        }

        return self::getSetting(self::$homeHero, self::$homeHeroName);
    }

    /**
     * @return array|[title, description, background]
     */
    static function getHomeVideoOrImageBoxSettings()
    {
        return self::getSetting(self::$homeVideoOrImage, self::$homeVideoOrImageName);
    }


    /**
     * @param null $page => login, register, remember_pass, search, categories, become_instructor, blog, instructors, user_avatar, user_cover
     * @return string|array => [all pages]
     */
    static function getPageBackgroundSettings($page = null)
    {
        return self::getSetting(self::$pageBackground, self::$pageBackgroundName, $page);
    }


    /**
     * @param null $key => css, js
     * @return string|array => {css, js}
     */
    static function getCustomCssAndJs($key = null)
    {
        return self::getSetting(self::$customCssJs, self::$customCssJsName, $key);
    }

    /**
     * @return array
     */
    static function getReportReasons()
    {
        return self::getSetting(self::$reportReasons, self::$reportReasonsName);
    }

    /**
     * @param $template {String|nullable}
     * @return array
     */
    static function getNotificationTemplates($template = null)
    {
        return self::getSetting(self::$notificationTemplates, self::$notificationTemplatesName, $template);
    }

    /**
     * @return array
     */
    static function getSiteBankAccounts()
    {
        return self::getSetting(self::$siteBankAccounts, self::$siteBankAccountsName);
    }

    /**
     * @return array
     */
    static function getReferralSettings()
    {
        return self::getSetting(self::$referral, self::$referralName);
    }

    /**
     * @param $key
     * @return array
     */
    static function getContactPageSettings($key = null)
    {
        return self::getSetting(self::$contactPage, self::$contactPageName, $key);
    }

    /**
     * @param $key
     * @return array
     */
    static function get404ErrorPageSettings($key = null)
    {
        return self::getSetting(self::$Error404Page, self::$Error404PageName, $key);
    }

    /**
     * @param $key
     * @return array
     */
    static function getHomeSectionsSettings($key = null)
    {
        return self::getSetting(self::$homeSections, self::$homeSectionsName, $key);
    }

    /**
     * @param $key
     * @return array
     */
    static function getNavbarLinksSettings($key = null)
    {
        return self::getSetting(self::$navbarLink, self::$navbarLinkName, $key);
    }

    /**
     * @return array
     */
    static function getPanelSidebarSettings()
    {
        return self::getSetting(self::$panelSidebar, self::$panelSidebarName);
    }
}