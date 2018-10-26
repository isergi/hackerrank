<?php

if (!empty($data['requested_site'])) {
    $requestedSite = $data['requested_site'];
    if (!empty($data['login_hisotry_key']) ) {
        $action = $data['login_history_key'];
        $requireActionInfo = ['email_only_reg', 'email_pass_reg'];
        if (in_array($action, $requireActionInfo)) {
            $action .= '-' . $requestedSite;
        }
    } else {
        $mobileApps = ['iphoneapp', 'androidapp'];
        if (isset($data['registrationType']) && $data['registrationType'] == 'anonymous' && in_array($deviceType,  $mobileApps)) {
            $action = 'email_pass_reg_';
        } else {
            $action = 'register_and_login-' ;
        }
        $action .=  $requestedSite;
    }
}
