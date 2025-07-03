<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use App\Models\Admin\Menu;
use App\Models\Admin\Page;
use App\Models\Admin\MenuItem;
use Illuminate\Support\Str;
use DB;
use Session;


class MenuController extends MyController
{

  public function index()
  {

    $desiredMenu = $this->getDesiredMenu();
    $MenuItems = $this->getMenuItems($desiredMenu);

    $data['categories'] = Page::all();
    $data['desiredMenu'] = $desiredMenu;
    $data['MenuItems'] = $MenuItems;
    $data['menus'] = Menu::all();

    return $this->adminView('admin.menu.index', $data);
  }

  protected function getDesiredMenu()
  {
    // Fetch the desired menu based on 'id' parameter or get the latest one
    if (isset($_GET['id']) && $_GET['id'] != 'new') {
      return Menu::find($_GET['id']);
    }else{
      return Menu::find(3);
    }

    return Menu::latest()->first();
  }

  protected function getMenuItems($desiredMenu)
  {
    if ($desiredMenu->content != '') {
      return $this->decodeMenuContent($desiredMenu->content);
    }

    return MenuItem::where('menu_id', $desiredMenu->id)->get();
  }

  protected function decodeMenuContent($content)
  {
    // Decode the menu content from JSON and populate additional fields
    $menuItems = is_string($content) ? json_decode($content, true) : $content;
    $menuItems = $menuItems[0] ?? [];

    foreach ($menuItems as &$menu) {
      $this->populateMenuItemData($menu);
      if (!empty($menu['children'][0])) {
        foreach ($menu['children'][0] as &$child) {
          $this->populateMenuItemData($child);
          if (!empty($child['children'][0])) {
            foreach ($child['children'][0] as &$grand) {
              $this->populateMenuItemData($grand);
            }
          }
        }
      }
    }

    return $menuItems;
  }


  protected function populateMenuItemData(&$menuItem)
  {
    // Fetch all necessary data in a single query
    $menuItemData = MenuItem::find($menuItem['id']);

    if ($menuItemData) {
      // Assign values from the fetched model to the menu item
      $menuItem['title'] = $menuItemData->title;
      $menuItem['name'] = $menuItemData->name;
      $menuItem['slug'] = $menuItemData->slug;
      $menuItem['target'] = $menuItemData->target;
      $menuItem['type'] = $menuItemData->type;
    }
  }

  public function addCatToMenu(Request $request)
  {
    $menu = Menu::findOrFail($request->menuid);
    $ids = $request->ids;

    foreach ($ids as $id) {
      $this->addPageToMenu($menu, $id);
    }

    if ($menu->content != '') {
      $this->updateMenuContent($menu, $ids, 'category');
    }

    return response()->json(['status' => 'success']);
  }

  protected function addPageToMenu($menu, $id)
  {
    $data = [
      'title' => Page::where('id', $id)->value('title'),
      'slug' => Page::where('id', $id)->value('url'),
      'type' => 'category',
      'menu_id' => $menu->id,
      'updated_at' => NULL
    ];

    MenuItem::create($data);
  }

  protected function updateMenuContent($menu, $ids, $type)
  {
    $oldData = json_decode($menu->content, true);
    foreach ($ids as $id) {
      $newItem = $this->createMenuArray($id, $type);
      array_push($oldData[0], $newItem);
    }
    $menu->update(['content' => json_encode($oldData)]);
  }
  protected function createMenuArray($id, $type)
  {
    $model = Page::class;

    $title = $model::where('id', $id)->value('title');
    $slug =  $model::where('id', $id)->value('url'); 

    $data = [
      'title' => $model::where('id', $id)->value('title'),
      'slug' => $model::where('id', $id)->value('url'),
      'name' => NULL,
      'type' => $type,
      'target' => NULL,
      'id' => MenuItem::where('slug', $slug)->where('type', $type)->value('id'),
      'children' => [[]],
      'grandchildren' => [[]]
    ];

    return $data;
  }

  public function addPostToMenu(Request $request)
  {
    $menu = Menu::findOrFail($request->menuid);
    $ids = $request->ids;

    foreach ($ids as $id) {
      $this->addPostToMenuItem($menu, $id);
    }

    if ($menu->content != '') {
      $this->updateMenuContent($menu, $ids, 'post');
    }

    return response()->json(['status' => 'success']);
  }

  protected function addPostToMenuItem($menu, $id)
  {
    $data = [
      'title' => Post::where('id', $id)->value('title'),
      'slug' => Post::where('id', $id)->value('slug'),
      'type' => 'post',
      'menu_id' => $menu->id,
      'updated_at' => NULL
    ];

    MenuItem::create($data);
  }
  public function addCustomLink(Request $request)
  {
    $menu = Menu::findOrFail($request->menuid);
    $linkData = [
      'title' => $request->link,
      'slug' => $request->url,
      'type' => 'custom',
      'menu_id' => $menu->id,
      'updated_at' => NULL
    ];

    MenuItem::create($linkData);

    if ($menu->content != '') {
      $this->updateMenuContentForCustomLink($menu, $linkData);
    }

    return response()->json(['status' => 'success']);
  }
  protected function updateMenuContentForCustomLink($menu, $linkData)
  {
    $oldData = json_decode($menu->content, true);
    $newLink = $this->createCustomLinkArray($linkData);
    array_push($oldData[0], $newLink);
    $menu->update(['content' => json_encode($oldData)]);
  }
  protected function createCustomLinkArray($linkData)
  {
    return [
      'title' => $linkData['title'],
      'slug' => $linkData['slug'],
      'name' => NULL,
      'type' => 'custom',
      'target' => NULL,
      'id' => MenuItem::where('slug', $linkData['slug'])->where('name', $linkData['name'])->where('type', 'custom')->value('id'),
      'children' => [[]],
      'grandchildren' => [[]]
    ];
  }


  public function store(Request $request)
  {
    $mdata = $request->validate([
      'title' => 'required|string',
      // Add other fields you need to validate
    ]);

    if (Menu::create($mdata)) {
      $newdata = Menu::orderBy('id', 'DESC')->first();
      session::flash('success', 'Menu saved successfully!');
      return redirect('admin/manage-menus?id='.$newdata->id)->with('success', 'Menu created successfully');

    } else {
      return redirect()->back()->with('error', 'Failed to save menu!');
    }
  }
  public function updateMenu(Request $request)
  {
    $newdata = $request->validate([
      'location' => 'required|string',
    ]);

    $menu = Menu::findOrFail($request->menuid);
    $newdata['content'] = json_encode($request->data);
    $menu->update($newdata);

    return redirect('admin/manage-menus?id='.$menu->id)->with('success', 'Menu item updated successfully');
  }


  public function updateMenuItem(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string',
      'slug' => 'required|string',
      // Add other fields you need to validate
    ]);

    $item = MenuItem::findOrFail($request->id);
    $item->update($data);
    return redirect('admin/manage-menus')->with('success', 'Menu item updated successfully');
  }

  public function deleteMenuItem($id, $key, $in = '')
  {
   
    $MenuItem = MenuItem::findOrFail($id);
    $menu = Menu::findOrFail($MenuItem->menu_id);
 
    if (!empty($menu->content)) {
      $data = json_decode($menu->content, true);
      if (isset($data[0][$key])) {
        if ($in === '') {
          unset($data[0][$key]);
        } elseif ($in === 'children') {
          unset($data[0][$key]['children'][0][$in]);
        } else {
          unset($data[0][$key]['children'][0][$in]);
        }
        $menu->update(['content' => json_encode($data)]);
      }
    }

    $MenuItem->delete();
    return redirect('admin/manage-menus')->with('success', 'Menu item deleted successfully');

  }

  public function destroy(Request $request)
  {
    $menu = Menu::findOrFail($request->id);
    MenuItem::where('menu_id', $menu->id)->delete();
    $menu->delete();
    return redirect('admin/manage-menus')->with('success', 'Menu deleted successfully');
  }
}
