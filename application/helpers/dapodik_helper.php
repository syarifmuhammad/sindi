<?php defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('dapodik_data')) {
 	function dapodik_data($url,$needlogin,$methode,$post_data=false) {
 		if($needlogin=='login'){
			// LOGIN //
			$url1        = 'https://datadik.kemdikbud.go.id/acc/login';
			$result1    = httpsCurl($url1);
			
			// GO-LOGIN //
			$fields = array(
				'action'=>urlencode('https://datadik.kemdikbud.go.id/acc/login')
				, 'user'=>urlencode(config_item('dapodik_user'))
				, 'pass'=>urlencode(config_item('dapodik_pass'))
			);
			$url2        = 'https://datadik.kemdikbud.go.id/acc/login';
			$result2    = httpsCurl($url2,$url1,$fields);
			
			// GRAB URL //
			if($methode=='post'){			
				$send_data = $post_data;
				$url3        = $url;
				$result3    = httpsCurl($url3,$url2,$send_data);

				return $result3;
			} else {
				$url3        = $url;
				$result3    = httpsCurl($url3,$url2);

				return $result3;
			}
		} else {
			// GRAB URL //
			if($methode=='post'){			
				$send_data = $post_data;
				$url3        = $url;
				$result3    = httpsCurl($url3,false,$send_data);

				return $result3;
			} else {
				$url3        = $url;
				$result3    = httpsCurl($url3);

				return $result3;
			}
		}
 	}
}

if (! function_exists('sipintar_data')) {
 	function sipintar_data($url,$needlogin,$methode,$post_data=false) {
 		if($needlogin=='login'){
			// LOGIN //
			$url1        = 'https://pip.kemdikbud.go.id/enterprise/session';
			$result1    = httpsCurl($url1);
			
			// GO-LOGIN //
			$fields = array(
				'action'=>urlencode('https://pip.kemdikbud.go.id/enterprise/session/start')
				, 'username'=>urlencode(config_item('sipintar_user'))
				, 'password'=>urlencode(config_item('sipintar_pass'))
				, 'login_type'=>urlencode('kabupaten')
			);
			$url2        = 'https://pip.kemdikbud.go.id/enterprise/session/start';
			$result2    = httpsCurl($url2,$url1,$fields);
			
			// GRAB URL //
			if($methode=='post'){			
				$send_data = $post_data;
				$url3        = $url;
				$result3    = httpsCurl($url3,$url2,$send_data);

				return $result3;
			} else {
				$url3        = $url;
				$result3    = httpsCurl($url3,$url2);

				return $result3;
			}
		} else {
			// GRAB URL //
			if($methode=='post'){			
				$send_data = $post_data;
				$url3        = $url;
				$result3    = httpsCurl($url3,false,$send_data);

				return $result3;
			} else {
				$url3        = $url;
				$result3    = httpsCurl($url3);

				return $result3;
			}
		}
 	}
}