<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
  function css_url($nom)
  {
    return base_url() . 'assets/css/' . $nom . '.css';
  }
}

if ( ! function_exists('js_url'))
{
  function js_url($nom)
  {
    return base_url() . 'assets/javacript/' . $nom . '.js';
  }
}

if ( ! function_exists('img_url'))
{
  function img_url($nom)
  {
    return base_url() . 'assets/images/' . $nom;
  }
}

if ( ! function_exists('img'))
{
  function img($nom, $alt = '')
  {
    return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
  }
}

if ( ! function_exists('img_onmouseover'))
{
  function img_onmouseover($nom, $nombis)
  {
    return '<img src = "'.img_url($nom).'" class="img-responsive" style="width:100%" alt="image du produit" onmouseover = "javascript:this.src = \''.img_url($nombis).'\'" onmouseout = "javascript:this.src = \''.img_url($nom).'\'"/>';
  }
}

