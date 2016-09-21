

<?php
defined('_JEXEC') or die('Restricted access');
 
function pagination_list_footer($list)
{
 // Initialize variables
 $lang =& JFactory::getLanguage();
 $html = "<ul class=\"list-footer\">\n";
 
 $html .= "\n<div class=\"limit\">".JText::_('Display Num').$list['limitfield']."</div>";
 $html .= $list['pageslinks'];
 $html .= "\n<div class=\"counter\">".$list['pagescounter']."</div>";
 
 $html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"".$list['limitstart']."\" />";
 $html .= "\n</div>";
 
 return $html;
}
 
function pagination_list_render($list)
{
 // Initialize variables
 $lang =& JFactory::getLanguage();
 $html = "<ul class=\"pagination\">";
 // Если выбрана первая страния то не показываем ссылки "Первая" и "Предыдущая"
 if ($list['start']['active'])
 {
 $html .= $list['start']['data'];
 $html .= $list['previous']['data'];
 }
 foreach( $list['pages'] as $page )
 {
 if($page['data']['active']) {
 // $html .= '<strong>';
 }
 
 $html .= $page['data'];
 
 if($page['data']['active']) {
 // $html .= '</strong>';
 }
 }
 // Если выбрана последняя страния то не показываем ссылки "Следующая" и "Последняя"
 if ($list['end']['active']) 
 {
 $html .= $list['next']['data'];
 $html .= $list['end']['data'];
 }
 
 $html .= "</ul>";
 return $html;
}
 
function pagination_item_active(&$item) {
 
$cls = '';

    // Check for "Next" item
    if ($item->text == JText::_('JNEXT'))
    {
        $display = '<i class="fa fa-angle-right"></i>';
    }
    // Check for "Prev" item
    if ($item->text == JText::_('JPREV'))
    {
        $display = '<i class="fa fa-angle-left"></i>';
    }
    
    if ($item->text == JText::_('First')) {
        $cls = "first";
    }
    if ($item->text == JText::_('Last'))   {
        $cls = "last";
    }

    if ( $item->text == JText::_( 'JLIB_HTML_START' ) ) {
        $display = '<i class="fa nach"></i>';
    }

    if ( $item->text == JText::_( 'JLIB_HTML_END' ) ) {
        $display = '<i class="fa kon"></i>';
    }

    if (!isset($display))
    {
        $display = $item->text;
    }
    //$show = 
    //$show = "<li><a href=\"" . $item->link . "\" >read more</a>";
    return "<li><a title=\"" . $item->text . "\" href=\"" . $item->link . "\" class=\"pagenav\">" . $display . "</a></li>";
 
}
 
function pagination_item_inactive(&$item) {
 return "<li><span>".$item->text."</span></li>";
}
?>

