<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\manage\Admin_menu;

class Adminmenu extends Controller
{
    private $__queryStatus = FALSE;
	private $__id = NULL;
	private $__encId = NULL;
	private $__lastInsId = 0;

  

   public function index(){
        $this->data['Record'] = Admin_menu::all();	
	    $this->admin_view('admin.menu.index',compact($this->data));
    }
}
