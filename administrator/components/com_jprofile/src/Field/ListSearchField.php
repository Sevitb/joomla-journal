<?php

namespace Kima\Component\jprofile\Administrator\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;
use Joomla\Database\ParameterType;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Language;

defined('_JEXEC') or die;

class ListSearchField extends ListField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $type = 'listSearch';

    /**
     * Name of the layout being used to render the field
     *
     * @var    string
     * @since  1.0.0
     */
    protected $layout = 'journal.jprofile.form.field.searchList';


    /**
     * Method to get the field input markup for a generic list.
     * Use the multiple attribute to enable multiselect.
     *
     * @return  string  The field input markup.
     *
     * @since   1.0.0
     */
    protected function getInput()
    {
        $data = $this->getLayoutData();

        $data['options'] = (array) $this->getOptions();
        $data['ajax'] = 0;

        return $this->getRenderer($this->layout)->render($data);
    }


    /**
     * Method to get the field options.
     *
     * @return  array  The field option objects.
     *
     * @since   1.0.0
     */
    protected function getOptions()
    {
        switch (Factory::getLanguage()->getTag()) {
            case 'ru-RU':
                $lang = 0;
                break;
            case 'en-GB':
                $lang = 3;
                break;
            default:
                $lang = 0;
                break;
        }

        $conutry_codes = ['AU','AT','AZ','AX','AL','DZ','UM','VI','AS','AI','AO','AD','AQ','AG','AR','AM','AW','AF','BS','BD','BB','BH','BZ','BY','BE','BJ','BM','BG','BO','BA','BW','BR','IO','VG','BN','BF','BI','VU','VA','GB','HU','VE','TL','VN','GA','HT','GY','GP','GT','GN','GW','DE','GI','HN','HK','GD','GL','GR','GE','GU','DK','CD','DJ','DM','DO','EU','EG','ZM','EH','ZW','IL','IN','ID','JO','IQ','IR','IE','IS','ES','IT','YE','KP','CV','KZ','KY','KH','CM','CA','QA','KE','CY','KG','KI','CN','CC','CO','KM','CR','CI','CU','KW','LA','LV','LS','LR','LB','LY','LT','LI','LU','MU','MR','MG','YT','MO','MK','MW','MY','ML','MV','MT','MA','MQ','MH','MX','MZ','MD','MC','MN','MS','MM','NA','NR','NP','NE','NG','AN','NL','NI','NU','NC','NZ','NO','AE','OM','CX','CK','HM','PK','PW','PS','PA','PG','PY','PE','PN','PL','PT','PR','CG','RE','RU','RW','RO','US','SV','WS','SM','ST','SA','SZ','SJ','MP','SC','SN','VC','KN','LC','PM','RS','CS','SG','SY','SK','SI','SB','SO','SD','SR','SL','SU','TJ','TH','TW','TZ','TG','TK','TO','TT','TV','TN','TM','TR','UG','UZ','UA','UY','FO','FM','FJ','PH','FI','FK','FR','GF','PF','TF','HR','CF','TD','ME','CZ','CL','CH','SE','LK','EC','GQ','ER','EE','ET','ZA','KR','GS','JM','JP','BV','NF','SH','TC','WF'];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.vk.com/method/database.getCountries',
            CURLOPT_POSTFIELDS => [
                'need_all' => 1,
                'lang' => $lang,
                'code' => 'AU, AT, AZ, AX, AL, DZ, UM, VI, AS, AI, AO, AD, AQ, AG, AR, AM, AW, AF, BS, BD, BB, BH, BZ, BY, BE, BJ, BM, BG, BO, BA, BW, BR, IO, VG, BN, BF, BI, VU, VA, GB, HU, VE, TL, VN, GA, HT, GY, GP, GT, GN, GW, DE, GI, HN, HK, GD, GL, GR, GE, GU, DK, CD, DJ, DM, DO, EU, EG, ZM, EH, ZW, IL, IN, ID, JO, IQ, IR, IE, IS, ES, IT, YE, KP, CV, KZ, KY, KH, CM, CA, QA, KE, CY, KG, KI, CN, CC, CO, KM, CR, CI, CU, KW, LA, LV, LS, LR, LB, LY, LT, LI, LU, MU, MR, MG, YT, MO, MK, MW, MY, ML, MV, MT, MA, MQ, MH, MX, MZ, MD, MC, MN, MS, MM, NA, NR, NP, NE, NG, AN, NL, NI, NU, NC, NZ, NO, AE, OM, CX, CK, HM, PK, PW, PS, PA, PG, PY, PE, PN, PL, PT, PR, CG, RE, RU, RW, RO, US, SV, WS, SM, ST, SA, SZ, SJ, MP, SC, SN, VC, KN, LC, PM, RS, CS, SG, SY, SK, SI, SB, SO, SD, SR, SL, SU, TJ, TH, TW, TZ, TG, TK, TO, TT, TV, TN, TM, TR, UG, UZ, UA, UY, FO, FM, FJ, PH, FI, FK, FR, GF, PF, TF, HR, CF, TD, ME, CZ, CL, CH, SE, LK, EC, GQ, ER, EE, ET, ZA, KR, GS, JM, JP, BV, NF, SH, TC, WF',
                'v' => '5.131',
                'access_token' => '1df18d1b1df18d1b1df18d1bd31ee350b811df11df18d1b7e0c52fe2879d39278ce0ef6'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data'
            ]
        ]);

        $countries = json_decode(curl_exec($curl))->response->items;

        curl_close($curl);

        foreach ($countries as $country) {
            $countries_list[(int)$country->id] = $country->title;
        }

        // Merge any additional options in the XML definition.
        if (!empty($countries_list)) {
            $options = parent::getOptions() + $countries_list;
        } else {
            $options = parent::getOptions();
        }

        return $options;
    }
}
