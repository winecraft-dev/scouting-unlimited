<?php
class IndexPageController extends Controller
{
  public function display()
  {
    if(Session::isLoggedIn())
    {
      (new IndexPageView())->render();
    }
    else
    {
      header("Location: /?c=login");
    }
  }
}
