<?php
/**
 * ZT News
 * 
 * @package     Joomla
 * @subpackage  Module
 * @version     2.0.0
 * @author      ZooTemplate 
 * @email       support@zootemplate.com 
 * @link        http://www.zootemplate.com 
 * @copyright   Copyright (c) 2015 ZooTemplate
 * @license     GPL v2
 */
defined('_JEXEC') or die('Restricted access');

// Get items
$items = modZTNewsHelper::getItems($params);

$totalItemsPerSlide = $numberIntroItems + $numberLinkItems;
$index = 0;
$count = 0;
foreach ($items as $item)
{
    $list[$index][] = $item;
    $count++;
    if ($count == $totalItemsPerSlide)
    {
        $index++;
        $count = 0;
    }

}
$doc = JFactory::getDocument();
$doc->addStyleSheet(JUri::root() . 'modules/mod_zt_news/assets/css/styles.css');
$commentsAPI = JPATH_SITE . '/components/com_jcomments/jcomments.php'; 
?>
<div class="wrapper">
    <?php foreach ($list as $key => $slide) : ?>    
        <div class="item">
            <?php 
            $listItems = array_slice($slide, $numberIntroItems);
            ?>

            <div class="zt-category newsiv3"> 
                <div class="zt-main-items row">
                    <?php $index = 0; ?>
                    <?php foreach ($slide as $key => $item) : 

                    if (file_exists($commentsAPI)) {
                        require_once($commentsAPI);   
                        $count_comment = JComments::getCommentsCount($item->id, 'com_content');   
                    } 
                    ?>         
                    <?php if ($index < $numberIntroItems) : ?>
                        <div class="col-md-<?php echo 12/$columns ?> col-sm-6 col-xs-12">
                            <div class="zt-item">
                                <?php if($isImage):?>
                                    <!-- Head Thumbnail -->
                                    <div class="post-thumnail">
                                        <div class="cat-title">
                                            <?php echo $item->cat_title; ?>
                                        </div>
                                        <a href="<?php echo $item->link; ?>" title="">
                                            <?php if (!empty($item->thumb)) : ?>
                                                <img src="<?php echo $item->thumb; ?>" 
                                                alt="<?php echo $item->title; ?>"
                                                title="<?php echo $item->title; ?>"
                                                />
                                            <?php endif; ?>

                                        </a>
                                    </div>
                                    <?Php endif;?>
                                    <div class="zt-article_content">
                                        <div class="mask">                                            
                                            <!-- Item title -->
                                            <?php if ($showTitle) : ?>
                                                <h3 class="title-post">
                                                    <a href="<?php echo $item->link; ?>" title="">
                                                        <?php echo $item->title; ?>
                                                    </a>
                                                </h3>
                                            <?php endif; ?>
                                            <!-- Intro text -->
                                            <?php if ($showIntro && $item->introtext != false) : ?>
                                                <div class="zt-introtext">
                                                    <?php echo preg_replace( "/^\.+|\.+$/", "", $item->metadesc) ; ?>
                                                    <!--?php print_r($item); ?-->    
                                                </div>
                                            <?php endif; ?> 
                                            <!-- Created -->
                                            <?php if ($showCreated) : ?>                            
                                                <div class="post-info">
                                                    <i class="fa fa-clock-o"></i> 
                                                    <?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?> <?php
                                                    ?>
                                                    <span class="tt-cmt">
                                                        <i class="fa fa-comments"></i>
                                                        <?php echo $count_comment ?>
                                                    </span>
                                                    <span class="tt-view"> <i class="fa fa-bolt"></i><?php echo $item->hits ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <!-- Readmore -->
                                            <?php if ($showReadmore) : ?>           
                                                <a class="rit-readmore" href="<?php echo $item->link; ?>"><?php echo JTEXT::_('READ MORE'); ?></a>
                                            <?php endif; ?>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>      
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </div>

                <div class="zt-list-items">
                    <?php foreach ($listItems as $key => $item) : ?>
                        <div class="zt-item">
                            <?php if($showImageOnList):?>
                                <div class="post-thumnail"> 
                                eff                     
                                    <a href="<?php echo $item->link; ?>" title="">
                                        <!-- List thumbnail -->
                                        <?php if (!empty($item->subThumb)) : ?>
                                            <img src="<?php echo $item->subThumb; ?>" 
                                            alt="<?php echo $item->title; ?>"
                                            title="<?php echo $item->title; ?>"
                                            />
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="zt-article_content header-blog-item">
                                <?php if ($showTitle) : ?>
                                    <h3 class="title-post">
                                        <a href="<?php echo $item->link; ?>" title="">
                                            <?php echo $item->title; ?>
                                        </a>
                                    </h3>
                                <?php endif; ?>
                                <!-- Created -->    
                                <?php if ($showCreated) : ?>                            
                                    <div class="post-info">
                                        <i class="fa fa-clock-o"></i> 
                                        <?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?> - <?php
                                        ?>
                                        <span class="tt-cmt">
                                            <i class="fa fa-comments"></i>
                                            <?php echo $count_comment ?>
                                        </span>
                                        <span class="tt-view"> <i class="fa fa-bolt"></i><?php echo $item->hits ?></span>
                                    </div>
                                <?php endif; ?>
                                <!-- Intro text -->
                                <?php if ($showIntroList && $item->introtext != false) : ?>
                                    <div class="zt-introtext"><?php echo preg_replace( "/^\.+|\.+$/", "", substr($item->introtext, 0, $intro_legnth) ); ?></div>
                                <?php endif; ?> 
                                <!-- Readmore -->
                                <?php if ($showReadmore) : ?>                     
                                    <p class="zt-news-readmore">
                                        <a class="readmore" href="<?php echo $item->link; ?>"><?php echo JTEXT::_('READ MORE'); ?></a>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div> 
            </div>

        </div>
    <?php endforeach; ?>               
</div>