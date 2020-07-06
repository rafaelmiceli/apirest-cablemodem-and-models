<?php

namespace App\Models;

use App\Classes\Db;

class DocsisUpdateModel extends Model
{
    protected $table = 'docsis_update';
 
    protected $fields = [
        'modem_macaddr',
        'ipaddr',
        'cmts_ip',
        'agentid',
        'version',
        'mce_concat',
        'mce_ver',
        'mce_frag',
        'mce_phs',
        'mce_igmp',
        'mce_bpi',
        'mce_ds_said',
        'mce_us_sid',
        'mce_filt_dot1p',
        'mce_filt_dot1q',
        'mce_tetps',
        'mce_ntet',
        'mce_dcc',
        'thetime',
        'offer_time',
        'ack_time',
        'net_id',
        'cluster_id',
        'ra_id',
        'vsi_devtype',
        'vsi_esafetypes',
        'vsi_serialno',
        'vsi_hwver',
        'vsi_swver',
        'vsi_bootrom',
        'vsi_oui',
        'vsi_model',
        'vsi_vendor'
    ];

    /**
     * filters records by vendor
     * @param string $vendor vendor name
     * @return array
     */
    public function get_by_vendor($vendor = null) {

        return $this->get($this->table, implode(',', $this->fields), "vsi_vendor like ?", ["%$vendor%"]);
    }
}
