<?php
   /*
   Plugin Name: Urban Push
   Plugin URI: http://sonnyparlin.com/2012/05/introducing-urban-push/
   Description: A plugin that uses the urban airship API to send a push notification from the post creation page.
   Version: 1.0.5
   Author: Sonny Parlin
   Author URI: http://sonnyparlin.com
   */

include('settings.php');
add_action( 'admin_init', 'push_add_custom_box', 1 );
add_action( 'save_post', 'push_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function push_add_custom_box() {
    add_meta_box( 
        'push_sectionid',
        __( 'Send Push Notification', 'push_textdomain' ),
        'push_inner_custom_box',
        'post',
        'side',
        'high' 
    );
}

/* Prints the box content */
function push_inner_custom_box( $post ) {

  wp_nonce_field( plugin_basename( __FILE__ ), 'push_noncename' );

  // The actual fields for data entry

  echo '<textarea name="push" value="" style="width:100%"/></textarea><br/>';
  echo 'Enter Password:<br/>';
  echo '<input type="password" name="password" style="width:100%"/><br/>';
}

function send_push($post_id, $appname, $appkey, $appmaster) {

    $auth = $appkey{'text_string'} . ":" . $appmaster{'text_string'};
    $url = "https://go.urbanairship.com/api/push/broadcast/";
    $data_string = '{ "badge": "+1", "aps": { "alert": "'.$_POST["push"].'", "sound": "default" }  }';
    $android_data_string = '{"android": {"alert": "'.$_POST["push"].'"}}';

    if (strstr($appname{'text_string'}, "Android")) {
      $data_string = $android_data_string;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERPWD, $auth);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
    );
    $xmlResponse = curl_exec($ch);
    curl_close($ch);

    update_post_meta($post_id, 'push sent for ' . $appname{'text_string'}, $xmlResponse);
}

function push_save_postdata( $post_id ) {

    global $flag;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return;

    if (empty($_POST["password"]))
      return;

    $pass = get_option("urbanpush_password");
    if (!strstr($_POST["password"], $pass{'text_string'}))
      return;

    if (empty($_POST["push"])) 
      return;


    if ($flag == 0) {

      $appname = get_option("urbanpush_appname");
      $appkey = get_option("urbanpush_appkey");
      $appmaster = get_option("urbanpush_appmaster");
      if ($appname{'text_string'} && !empty($appname{'text_string'}))
        send_push($post_id, $appname, $appkey, $appmaster);

      $appname2 = get_option("urbanpush_appname2");
      $appkey2 = get_option("urbanpush_appkey2");
      $appmaster2 = get_option("urbanpush_appmaster2");
      if ($appname2{'text_string'} && !empty($appname2{'text_string'}))
        send_push($post_id, $appname2, $appkey2, $appmaster2);

      $appname3 = get_option("urbanpush_appname3");
      $appkey3 = get_option("urbanpush_appkey3");
      $appmaster3 = get_option("urbanpush_appmaster3");
      if ($appname3{'text_string'} && !empty($appname3{'text_string'}))
        send_push($post_id, $appname3, $appkey3, $appmaster3);

      $appname4 = get_option("urbanpush_appname4");
      $appkey4 = get_option("urbanpush_appkey4");
      $appmaster4 = get_option("urbanpush_appmaster4");
      if ($appname4{'text_string'} && !empty($appname4{'text_string'}))
        send_push($post_id, $appname4, $appkey4, $appmaster4);
    }

    $flag = 1;
}
?>
