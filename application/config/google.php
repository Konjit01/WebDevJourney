<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '621317945474-2kts4hlg40s5bg6fh30mse978a59d8ov.apps.googleusercontent.com';
$config['google']['client_secret']    = '7X5R7dvIq-5ImOQAhi8boDxA';
$config['google']['redirect_uri']     = 'https://sharingwisdom.000webhostapp.com/users/google_login/';
$config['google']['application_name'] = 'Login to Wisdom';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();