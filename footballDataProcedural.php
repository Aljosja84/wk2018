<?php
  $uri = 'http://api.football-data.org/v1/competitions/467';
  $reqPrefs['http']['method'] = 'GET';
  $reqPrefs['http']['header'] = 'X-Auth-Token: 6441847af72d4e808cedfeaf727e24ef';

  $stream_context = stream_context_create($reqPrefs);
  $response = file_get_contents($uri, false, $stream_context);
  $data = json_decode($response);

  //echo title of competition
  echo $data->caption;
?>
