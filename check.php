<?php

function _is_curl_installed() {
         if  (in_array  ('curl', get_loaded_extensions())) {
                     return true;
                        }
            else {
                        return false;
                           }
}

if (_is_curl_installed()) {
   echo "cURL is <span style="color:blue">installed</span> on this server";
   } else {
     echo "cURL is NOT <span style="color:red">installed</span> on this server";
     }
