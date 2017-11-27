<?php
class Configuration {
  protected $data;
  protected $filename;
  public function __construct($filename) {
    $this->filename = $filename;
    $this->data = parse_ini_file($filename);
  }
  
  public function get($key) {
    return $this->data[$key];
  }
  
  public function set($key, $val) {
    $this->data[$key] = $val;
    $this->write_ini_file($this->data, $this->filename);
  }
  
  private function write_ini_file($assoc_arr, $path) {
    $content = ""; 
    foreach ($assoc_arr as $key=>$elem) { 
        if(is_array($elem)) { 
            for($i=0;$i<count($elem);$i++) 
            { 
                $content .= $key."[] = \"".$elem[$i]."\"\r\n"; 
            } 
        } else if($elem==='') {
          $content .= $key." = \r\n"; 
        } else {
          $content .= "$key = \"".$elem."\"\r\n";
        } 
    } 

    if (!$handle = fopen($path, 'w')) { 
        return false; 
    } 
    if (!fwrite($handle, $content)) { 
        return false; 
    } 
    fclose($handle); 
    return true; 
  }
}