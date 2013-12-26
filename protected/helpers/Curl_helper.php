<?php
class Curl_helper {


function get($username)
{
$headers = array( 
            "Accept: */*", 
            "Referer: https://free-lance.ru", 
            "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)", 
            "Host: www.free-lance.ru", 
            "Connection: Keep-Alive" 
); 
		
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_URL, 'https://www.free-lance.ru/users/'.$username.'/');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Сколько сек. ждать ответ сервреа
$page = self::curl_redir_exec($ch);
$page = curl_exec($ch);

curl_close($ch);

return $page;
}

function curl_redir_exec($ch)
  {
  static $curl_loops = 0;
  static $curl_max_loops = 20;
  if ($curl_loops >= $curl_max_loops)
    {
    $curl_loops = 0;
    return false;
    }
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($ch);
  list($header, $data) = explode("\n\n", $data, 2);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  
  if ($http_code == 301 || $http_code == 302)
    {
    $matches = array();
    preg_match('/Location:(.*?)\n/', $header, $matches);
    $url = @parse_url(trim(array_pop($matches)));
    if (!$url)
      {
      $curl_loops = 0;
      return $data;
      }
    $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
    
    if (!$url['scheme'])
      $url['scheme'] = $last_url['scheme'];
    if (!$url['host'])
      $url['host'] = $last_url['host'];
    if (!$url['path'])
      $url['path'] = $last_url['path'];
    $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query']?'?'.$url['query']:'');
    echo $new_url.' --- '.$http_code.'<br>';
    curl_setopt($ch, CURLOPT_URL, $new_url);
    return self::curl_redir_exec($ch);
    }
  else
    {
    $curl_loops = 0;
    return $data;
    }
  }
 

}