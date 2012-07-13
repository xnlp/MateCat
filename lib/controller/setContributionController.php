<?php
include INIT::$ROOT."/lib/utils/mymemory_queries_temp.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class setContributionController extends ajaxcontroller {

    private $id_customer;
    private $id_translator;
    private $private_customer;
    private $private_translator;
    private $source;
    private $target;
    private $source_lang;
    private $target_lang;

    public function __construct() {
        parent::__construct();

        $this->id_customer = $this->get_from_get_post('id_customer');
        if (empty($this->id_customer)) {
            $this->id_customer="Anonymous";
        }
        
        
        $this->id_translator = $this->get_from_get_post('id_translator');
        if (empty($this->id_translator)) {
            $this->id_translator="Anonymous";
        }
        
        $this->private_customer = $this->get_from_get_post('private_customer');
        if (empty ($this->private_customer)){
            $this->private_customer=0;
        }
        
        $this->private_translator = $this->get_from_get_post('private_translator');
         if (empty ($this->private_translator)){
            $this->private_translator=0;
        }
        
        $this->source = $this->get_from_get_post('source');
        $this->target = $this->get_from_get_post('target');
        $this->source_lang = $this->get_from_get_post('source_lang');
        $this->target_lang = $this->get_from_get_post('target_lang');   
    }

    public function doAction() {
        if (empty($this->source)) {
            $this->result['error'][] = array("code" => -1, "message" => "missing source segment");
        }
        
        if (empty($this->target)) {
            $this->result['error'][] = array("code" => -2, "message" => "missing target segment");
        }
        
        
        if (empty($this->source_lang)) {
            $this->result['error'][] = array("code" => -3, "message" => "missing source lang");
        }
        
        if (empty($this->target_lang)) {
            $this->result['error'][] = array("code" => -2, "message" => "missing target lang");
        }        

        if (!empty($this->result['error'])) {
            return -1;
        }


        $set_results = addToMM($this->source,$this->target,$this->source_lang,$this->target_lang);
        log::doLog($set_results);
            
        $this->result['code'] = 1;
        $this->result['data'] = "OK";
        
        
    }


}

?>


