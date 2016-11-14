<?php

/**
 * Simile Skin 
 *
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */

if( !defined( 'MEDIAWIKI' ) ) {
    die();
}

/** */
require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class SkinSimile extends SkinTemplate {
    function initPage( &$out ) {
        SkinTemplate::initPage( $out );
        $this->skinname  = 'simile';
        $this->stylename = 'simile';
        $this->template  = 'SimileTemplate';
    }
}

/**
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class SimileTemplate extends QuickTemplate {

    /**
     * Template filter callback for simile skin.
     * Takes an associative array of data set from a SkinTemplate-based
     * class, and a wrapper for MediaWiki's localization database, and
     * outputs a formatted page.
     *
     * @access private
     */
    function execute() {
        // Suppress warnings to prevent notices about missing indexes in $this->data
        wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
  <head>
    <meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
    <?php $this->html('headlinks') ?>
    <title><?php $this->text('pagetitle') ?></title>
    <style type="text/css" media="screen,projection">/*<![CDATA[*/ @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css"; /*]]>*/</style>
    <link rel="stylesheet" type="text/css" <?php if(empty($this->data['printable']) ) { ?>media="print"<?php } ?> href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
    <!--[if lt IE 5.5000]><style type="text/css">@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/IE50Fixes.css";</style><![endif]-->
    <!--[if IE 5.5000]><style type="text/css">@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/IE55Fixes.css";</style><![endif]-->
    <!--[if gte IE 6]><style type="text/css">@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/IE60Fixes.css";</style><![endif]-->
    <!--[if IE]><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/common/IEFixes.js"></script>
    <meta http-equiv="imagetoolbar" content="no" /><![endif]-->
    <?php if($this->data['jsvarurl'  ]) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl'  ) ?>"></script><?php } ?>
    <script type="<?php $this->text('jsmimetype') ?>" src="<?php                                   $this->text('stylepath' ) ?>/common/wikibits.js"></script>
    <?php if($this->data['usercss'   ]) { ?><style type="text/css"><?php              $this->html('usercss'   ) ?></style><?php    } ?>
    <?php if($this->data['userjs'    ]) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs'    ) ?>"></script><?php } ?>
    <?php if($this->data['userjsprev']) { ?><script type="<?php $this->text('jsmimetype') ?>"><?php      $this->html('userjsprev') ?></script><?php   } ?>
    <?php if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
    <?php $this->html('headscripts') ?>
  </head>
  <body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
        <?php if($this->data['body_onload'    ]) { ?>onload="<?php     $this->text('body_onload')     ?>"<?php } ?>
        <?php if($this->data['nsclass'        ]) { ?>class="<?php      $this->text('nsclass')         ?>"<?php } ?>>

        <script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>

      <div id="header">
       <table>
        <tr>
         <td id="path"><a href="/">Home</a> &raquo <a href="/wiki/">Wiki</a></td>
         <td id="actions">
          <ul>
            <?php foreach($this->data['personal_urls'] as $key => $item) { ?>
                  <li id="pt-<?php echo htmlspecialchars($key) ?>"<?php if ($item['active']) { ?> class="active"<?php } ?>>
                    <a href="<?php echo htmlspecialchars($item['href']) ?>"
                        <?php if(!empty($item['class'])) { ?> class="<?php echo htmlspecialchars($item['class']) ?>"<?php } ?>
                    >
                      <?php echo htmlspecialchars($item['text']) ?>
                    </a>
                  </li>
            <?php	} ?>
          </ul>         
         </td>
        </tr>
       </table>
      </div>

    <table id="frame">
     <tr>
      <td id="contentColumn">
      
      
      <ul id="tabs">        <?php foreach($this->data['content_actions'] as $key => $action) { ?>
          <li id="ca-<?php echo htmlspecialchars($key) ?>" 
            <?php if($action['class']) { ?>
                class="<?php echo htmlspecialchars($action['class']) ?>"
            <?php } ?>>
              <a href="<?php echo htmlspecialchars($action['href']) ?>"><?php echo htmlspecialchars($action['text']) ?></a>
          </li>
        <?php } ?>
      </ul>
      
       <div id="content">
        <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
        <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
        <?php $this->html('bodytext') ?>
        <?php if($this->data['catlinks']) { ?><div id="catlinks"><?php $this->html('catlinks') ?></div><?php } ?>
       </div>
      </td>
      <td id="sidebarColumn">
       <div id="sidebar">
        <div class="logo">         <a href="http://simile.mit.edu/" title="The SIMILE Project">          <img alt="Simile" src="http://simile.mit.edu/images/logo.png"/>         </a>        </div>
        
        <div id="search">
            <form name="searchform" action="<?php $this->text('searchaction') ?>" id="searchform">
              <input id="searchInput" name="search" type="text"
                <?php if($this->haveMsg('accesskey-search')) { ?>accesskey="<?php $this->msg('accesskey-search') ?>"<?php }?>
                <?php if( isset( $this->data['search'] ) ) {?> value="<?php $this->text('search') ?>"<?php } ?>
              /><input type='submit' name="fulltext" class="searchButton" value="<?php $this->msg('search') ?>" />
            </form>
        </div>

        <?php foreach ($this->data['sidebar'] as $bar => $cont) { ?>
          <div id="p-<?php echo htmlspecialchars($bar) ?>" class="portlet">
            <h2><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h2>
            <div class='pBody'>
              <ul>
              <?php foreach($cont as $key => $val) { ?>
                <li id="<?php echo htmlspecialchars($val['id']) ?>"><a href="<?php echo htmlspecialchars($val['href']) ?>"><?php echo htmlspecialchars($val['text'])?></a></li>
               <?php } ?>
              </ul>
            </div>
          </div>
        <?php } ?>

        <div id="p-tb" class="portlet">
          <h2><?php $this->msg('toolbox') ?></h2>
          <div class="pBody">
            <ul>
              <?php if($this->data['notspecialpage']) { ?>
                  <?php foreach( array( 'whatlinkshere', 'recentchangeslinked' ) as $special ) { ?>
                    <li id="t-<?php echo $special?>">
                      <a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href']) ?>">
                        <?php echo $this->msg($special) ?>
                      </a>
                    </li>
                  <?php } ?>
              <?php } ?>
              <?php if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
                <li id="t-trackbacklink">
                  <a href="<?php echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href']) ?>">
                    <?php echo $this->msg('trackbacklink') ?>
                  </a>
                </li>
              <?php } ?>
              <?php if($this->data['feeds']) { ?>
                <li id="feedlinks">
                  <?php foreach($this->data['feeds'] as $key => $feed) { ?>
                    <span id="feed-<?php echo htmlspecialchars($key) ?>">
                      <a href="<?php echo htmlspecialchars($feed['href']) ?>">
                        <?php echo htmlspecialchars($feed['text'])?>
                      </a>
                    </span>
                  <?php } ?>
                </li>
              <?php } ?>
              <?php foreach( array('contributions', 'emailuser', 'upload', 'specialpages') as $special ) { ?>
                <?php if($this->data['nav_urls'][$special]) {?>
                  <li id="t-<?php echo $special ?>">
                    <a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])?>">
                      <?php $this->msg($special) ?>
                    </a>
                  </li>
                <?php } ?>
              <?php } ?>
              <?php if(!empty($this->data['nav_urls']['print']['href'])) { ?>
                <li id="t-print">
                  <a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])?>">
                    <?php echo $this->msg('printableversion') ?>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>

        <?php if( $this->data['language_urls'] ) { ?>
          <div id="p-lang" class="portlet">
            <h2><?php $this->msg('otherlanguages') ?></h2>
            <div class="pBody">
              <ul>
                <?php foreach($this->data['language_urls'] as $langlink) { ?>
                  <li class="<?php echo htmlspecialchars($langlink['class'])?>">
                    <a href="<?php echo htmlspecialchars($langlink['href'])?>"><?php echo $langlink['text'] ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        <?php } ?>
      </div>
     </td>
    </tr>
   </table>

  <div id="footer">
   <table>
    <tr>
     <td>
       <?php if($this->data['lastmod']) { ?><?php $this->html('lastmod') ?><?php } ?>
       <?php if($this->data['viewcount']) { ?> ~ <?php $this->html('viewcount') ?><?php } ?>
       <?php if($this->data['numberofwatchingusers']) { ?> ~ <?php $this->html('numberofwatchingusers') ?><?php } ?>
     </td>
     <td rowspan="2">
      <?php if($this->data['copyrightico']) { ?><?php $this->html('copyrightico') ?><?php } ?>
      <?php if($this->data['poweredbyico']) { ?><?php $this->html('poweredbyico') ?><?php } ?>
     </td>
    </tr>
    <tr>
     <td>
      <div class="copyright">Copyright &copy; 2003-2008 <a href="http://www.mit.edu/">Massachusetts Institute of Technology</a></div>
     </td>
    </tr>
   </table>
  </div>
  
  <?php $this->html('reporttime') ?>
     
  </body>
</html>

<?php
        wfRestoreWarnings();
    }
}
?>
