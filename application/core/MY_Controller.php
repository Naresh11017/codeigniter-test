<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    public $template;

    function __construct()
    {
        parent::__construct();
        $this->template = $this->config->item("site_theme");
    }

    public function _remap($method, $params = array())
    {
        $class = get_class($this);
        $module = $class.'/'.$method;
        
        if (is_string($output = Modules::run($module, $params)))
        {
            $template_view = ($this->template=="admin")? 'admin/theme' : $this->template.'/theme';
            $template_path = 'themes/'.$template_view.EXT;
                        
            if (is_file($template_path))
            {
                $this->load->view("../../themes/".$template_view, array("module_output" => $output));
            }
            else
            {
                echo $output;
            }
        }
        else
        {
            show_404();
        }
    }

}