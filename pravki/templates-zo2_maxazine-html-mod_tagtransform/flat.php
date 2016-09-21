<?php
/**
 * @version     1.1.4
 * @package     mod_tagtransform
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *****@author      joomunited - contact@joomunited.com
 *****
 Copyright (c) 2012-2013 Thibaut Courouble Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:
The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.*/

defined('_JEXEC') or die;
$fatcloud_min_fontsize=$params->get('fatcloud_min_fontsize');
    $fatcloud_max_fontsize=$params->get('fatcloud_max_fontsize');
    $font_unit=$params->get('font_unit');
    $color_min=$params->get('fatcloud_min_tagcolor');
    $color_back=$params->get('back_tagcolor');
    $color_hover=$params->get('hover_tagcolor');
    
?>
<?php
if($cloud_format=="bootstrap")
{
    $document = JFactory::getDocument();
    JHtml::_('jquery.framework');
    JHtml::_('bootstrap.framework');
    $document->addScript(JURI::base().'modules/mod_tagtransform/assets/jquery.color.js');
    $document->addScript(JURI::base().'modules/mod_tagtransform/assets/bootstrap-tags.js');
    $outp = "[";
    ?>
    <?php foreach ($list as $i => $item) {

	if ($outp != "[") {$outp .= ",";}
	$outp .= '{"id":"'  . $i. '",';
	$outp .= '"text":"<span style=\"font-size:'.rand($fatcloud_min_fontsize,$fatcloud_max_fontsize).$font_unit.'\">'   . $item->title        . '</span>",';
	$outp .= '"num":"'   . $item->count        . '",';
	$outp .= '"url":"'. ModTagsTransformHelper::getUrl($item,$component)    . '"}'; 
     }
     $outp.="]";
    ?>
    <div id="bs-tags_<?php echo $module->id;?>"></div>
			<style type="text/css">
			    
				#bs-tags_<?php echo $module->id;?> .tag-badge {
					margin-right: 5px;
					margin-bottom: 5px;
					font-weight: 100;
					font-size: 14px;
					line-height: 20px;
				}
				#bs-tags_<?php echo $module->id;?> .tag-icon {
					margin-left: 5px;
					margin-right: -3px;
				}
				#bs-tags_<?php echo $module->id;?> .tag-badge a.tag-link {
					color: <?php echo $color_min; ?>;
					text-decoration: underline;
					
				}
				#bs-tags_<?php echo $module->id;?> .tag-input {
					border: 0 solid;
					margin: 0;
					padding: 0;
					font-weight: 100;
					border: 0 solid;
					background-color: transparent;
					height: 18px;
					margin-top: -5px;
					color: <?php echo $color_min; ?>;
					outline: none;
				}
				#bs-tags_<?php echo $module->id;?> sup small,
				#bs-tags_<?php echo $module->id;?> .tag-remove
				{
				    color: <?php echo $color_min; ?>;
					
				}
				#bs-tags_<?php echo $module->id;?> .label-info, .badge-info:hover {
				background:  <?php echo $color_hover;?>
				}
				#bs-tags_<?php echo $module->id;?> .label-info, .badge-info
				{
				      background: <?php echo $color_back; ?> !important;
				      background: none !important;
					position:relative !important;
				}
			</style>
			<script type="text/javascript">
			    var $tag = jQuery.noConflict();
	
	$tag('#bs-tags_<?php echo $module->id;?>').tags({
		values: <?php echo $outp;?>,
                can_add:false
	});
</script>
<?php }
else if($cloud_format=="drop")
{
    echo '<select onchange="document.location.href=this.options[this.selectedIndex].value;" name="ctc-dropdown" class="chzn-done"> <option value="">Select Tag</option>';

foreach ($list as $i => $item) :
?>
		
	<option value="<?php echo ModTagsTransformHelper::getUrl($item,$component); ?>" style='color:<?php echo ModTagsTransformHelper::ColorSwatch(70,$color_min,$color_max);?>;font-size:<?php echo rand($fatcloud_min_fontsize,$fatcloud_max_fontsize);?><?php echo $font_unit; ?>'  title="<?php echo htmlspecialchars($item->title); ?>" class="tag-link-<?php echo $i;?>">
		<?php echo htmlspecialchars($item->title); if($show_articlecount==1) { echo "(".$item->count.")";}?></option>
                
	<?php endforeach; ?>

<?php
echo '</select>';
}
else if($cloud_format=="slide")
{
    ?>
    <style type="text/css">
    .tags_<?php echo $module->id;?>:before, .tags_<?php echo $module->id;?>:after {
    content: "";
    display: table;
     list-style: none outside none;
    }
    .tags_<?php echo $module->id;?> li:after {
    background: none repeat scroll 0 0 <?php echo $color_hover;?>;
    content: "";
    height: 6px;
    opacity: 0.95;
    position: absolute;
    right: -2px;
    top: 10px;
    width: 5px;
    z-index: 2;
     list-style: none outside none;
    }
    .tags_<?php echo $module->id;?> li
    {
        list-style-type: none;
    margin: 6px 0 8px 12px;
    position: relative;
    float:left;
    }
    .well
    {
        float:left;
    }
     .tags_<?php echo $module->id;?> a {
    background: <?php echo $color_back; ?>;
    color: <?php echo $color_min; ?>;
    font-size: 12px;
    height: 26px;
    line-height: 23px;
    padding: 6px;
    text-decoration: none;
    border-radius:50px 0 0 50px;
    box-shadow:0 -1px 0 rgba(0, 0, 0, 0.05) inset;
    }
    .tags_<?php echo $module->id;?> span {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: <?php echo $color_hover;?>;

    border-image: none;
    height: 24px;
    left: 100%;
    line-height: 21px;
    max-width: 0;
    opacity: 0.95;
    overflow: hidden;
    padding: 0 0 0 2px;
    position: absolute;
    text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
    top: 1px;
    transition-delay: 0s;
    transition-duration: 0.3s;
    transition-property: padding, max-width;
    transition-timing-function: ease-out;
    z-index: 2;
}
.tags_<?php echo $module->id;?> a:hover span {
  padding: 0 7px 0 6px;
  max-width: 40px;
  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.15), 1px 1px 2px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.15), 1px 1px 2px rgba(0, 0, 0, 0.2);
}
    </style>
   <ul class="tags_<?php echo $module->id;?>">
   <?php foreach ($list as $i => $item) :
?>
                <li>
	<a href="<?php echo ModTagsTransformHelper::getUrl($item,$component); ?>"  title="<?php echo htmlspecialchars($item->title); ?>" class="tag-link-<?php echo $i;?>" style='color:<?php echo $color_min;?>;font-size:<?php echo rand($fatcloud_min_fontsize,$fatcloud_max_fontsize);?><?php echo $font_unit; ?>'>
		<?php echo htmlspecialchars($item->title); if($show_articlecount==1) { echo "<span>".$item->count."</span>";}?></a>
                </li>
	<?php endforeach; ?>
	</ul>	
<?php }
else
{
    ?>
    <style type="text/css">
	.tags_<?php echo $module->id;?>{
	margin:0;
	padding:0;
	list-style:none;
	}
	.tags_<?php echo $module->id;?> li
	{
	    margin:4px;
	    display: block;
	    float: left;
	}
	.tags_<?php echo $module->id;?> li, .tags_<?php echo $module->id;?> a{
	float:left;
	height:24px;
	line-height:24px;
	position:relative;
	}
	.tags_<?php echo $module->id;?> a{
	margin-left:20px;
	padding:0 10px 0 12px;
	background:<?php echo $color_back;?>;
	text-decoration:none;
	-moz-border-radius-bottomright:4px;
	-webkit-border-bottom-right-radius:4px;	
	border-bottom-right-radius:4px;
	-moz-border-radius-topright:4px;
	-webkit-border-top-right-radius:4px;	
	border-top-right-radius:4px;	
	}
	.tags_<?php echo $module->id;?> a:before{
	content:"";
	float:left;
	position:absolute;
	top:0;
	left:-12px;
	width:0;
	height:0;
	border-color:transparent <?php echo $color_back;?> transparent transparent;
	border-style:solid;
	border-width:12px 12px 12px 0;		
	}
	.tags_<?php echo $module->id;?> a:after{
	content:"";
	position:absolute;
	top:10px;
	left:0;
	float:left;
	width:4px;
	height:4px;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	background:#fff;
	-moz-box-shadow:-1px -1px 2px #004977;
	-webkit-box-shadow:-1px -1px 2px #004977;
	box-shadow:-1px -1px 2px #004977;
	}
	.well
	{
	    float:left;
	}
	.tags_<?php echo $module->id;?> a:hover{background:<?php echo $color_hover;?>;}	
	.tags_<?php echo $module->id;?> a:hover:before{border-color:transparent <?php echo $color_hover;?> transparent transparent;}
    </style>
    <ul class="tags_<?php echo $module->id;?>">
   <?php foreach ($list as $i => $item) :
?>
                <li>
	<a href="<?php echo ModTagsTransformHelper::getUrl($item,$component); ?>" style='color:<?php echo $color_min;?>;font-size:<?php echo rand($fatcloud_min_fontsize,$fatcloud_max_fontsize);?><?php echo $font_unit; ?>' class="css-flat" title="<?php echo htmlspecialchars($item->title); ?>" class="tag-link-<?php echo $i;?>">
		<?php echo htmlspecialchars($item->title); if($show_articlecount==1) { echo "(".$item->count.")";}?></a>
                </li>
	<?php endforeach; ?>
	</ul>
	<a class="all-tags" href="/tags.html">Все теги</a>
<?php
}
?>
