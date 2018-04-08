<?php 
    class MY_Controller extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
    }

    class Admin_Controller extends MY_Controller{
        function __construct(){
            parent::__construct();
        }
    }

    class Public_Controller extends MY_Controller{
        function __construct(){
            parent::__construct();

            $this->load->library('menu');

            $this->pages = $this->menu->get_pages();

            // Brand/Logo
            $this->brand = 'My Website';

            //banner
            $this->banner_heading = 'Welcome to Our Website!';
            $this->banner_text = 'This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll, this navbar remains in its original position and moves with the rest of the page.';
            $this->banner_link = 'pages/show/our-team';
        }
    }