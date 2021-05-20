<?php
function landing()
{
  require("./view/landing.php");
}
function aboutUs()
{
  require("./view/aboutUs.php");
}
function premium($whichPlan)
{
  if ($whichPlan === 'month') {
    $link = 'premiumCheckOut.php';
  } else if ($whichPlan === 'year') {
    $link = 'premiumCheckOut.php';
  }

  $link = $whichPlan ? 'premiumCheckOut.php' : 'premium.php';
  $plan = $whichPlan;
  $pricing = $whichPlan === 'month' ? '9.99' : '99';
  $expirationDate = $plan ? new \DateTime('1 ' . $plan) : '';


  require("./view/" . $link);
}
function addEditEvent()
{
  require("./view/addEditEvent.php");
}
