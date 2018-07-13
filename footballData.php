<?php

/**
 * This service class encapulates football-data.org's RESTful API
 *
 * @author  Gabriel Gressie <gabriel.gressie@gmail.com>
 * @date    10-06-2018
 *
 */
class FootballData {

  public $config;
  public $baseUri;
  public $reqPrefs = array();

  public function __construct() {
    $this->config = parse_ini_file('config.ini', true);

    /* check if auth token is set in the .ini file /*
    /* if not, let the user know */
    if($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
      exit('Get your API-key first and edit config.ini');
    }

    $this->baseUri = $this->config['baseUri'];

    $this->reqPrefs['http']['method'] = 'GET';
    $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
  }

  /**
   * Function returns a league table indentified by an id.
   *
   * @param   int     $id
   * @return  array   $result
   *
   */
   public function getLeagueTable() {
     $resource = 'leagueTable.json';
     $response = file_get_contents($this->baseUri . $resource, false,
                                   stream_context_create($this->reqPrefs));
     $result = json_decode($response, false);

     return $result;
   }

  /**
   * Function returns an array of all the fixtures of the given competition
   *
   * @return  array   $result
   *
   */
   public function getFixtures() {
     $resource = 'fixtures.json';
     $response = file_get_contents($this->baseUri . $resource, false,
                                   stream_context_create($this->reqPrefs));

     $result = json_decode($response);

     return $result;
   }
}
?>
