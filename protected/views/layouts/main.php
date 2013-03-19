<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/src/jquery.ui.position.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/src/jquery.contextMenu.js" type="text/javascript"></script>
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.lightbox_me.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/popup.css" />
    <script>
	var SITE_URL = "<?php echo Yii::app()->request->baseUrl; ?>";
	var parentId = 0;
	</script>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/src/jquery.contextMenu.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/myscript.js"></script>
    <?php if(isset(Yii::app()->user->email)) { ?>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filereader.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
    <?php } ?>
</head>

<body>
<?php if(isset(Yii::app()->user->email)) { ?>
<div id="folder">                
	<div id="sign_up_form">
		<label><strong>Folder Name:</strong> <input class="sprited" id="folderName" /></label>                    
		<div id="actions">
			<a class="close form_button sprited" id="cancel" href="#">Cancel</a>
			<a class="form_button sprited" id="try_it" href="javascript:createFolder();">Create</a>
		</div>
	</div>
	<a id="close_x" class="close sprited" href="#">close</a>
</div>
<?php }?>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?>
		<div class="logout">
		<?php if(isset(Yii::app()->user->email)) { ?>
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/logout" >
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logout.png" />
			</a>		
		<?php } else { ?>
		<input type="button" class="signup" value="Sign Up" onClick="javascript:popSighnup();" />&nbsp;
		<input type="button" class="signup" onClick="javascript:popLogin();" value="Sign In" />
		<?php } ?>
		</div>
		</div>
		
	</div><!-- header -->

	<div id="mainmenu">
		<?php /* $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */ ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<div class="folderHolder"><?php echo $content; ?></div>

<!-- <div class="context-menu-one box menu-1">
    <strong>right click me</strong>
</div> -->
	<?php if(isset(Yii::app()->user->email)) { ?>
<script type="text/javascript" class="showcase">
$(function(){
    $.contextMenu({
        selector: '.container', 
        callback: function(key, options) {
            //var m = "clicked: " + key;
            //window.console && console.log(m) || alert(m); 
            if(key == "newfolder")
            	$("#folder").lightbox_me({
                    //centered: true, 
                    onLoad: function() { 
                        $('#folder').find('input:first').focus()
                        }
                    });
           // e.preventDefault();
        },
        items: {
           // "edit": {name: "Open", icon: "open"},//edit
           // "cut": {name: "Cut", icon: "cut"},
           // "copy": {name: "Copy", icon: "copy"},
           // "paste": {name: "Paste", icon: "paste"},
           // "delete": {name: "Delete", icon: "delete"},
            "newfolder": {name: "New Folder", icon: "newfolder"},
            "sep1": "---------",
            "quit": {name: "Quit", icon: "quit"}
        }
    });

    $.contextMenu({
        selector: '.folderContainer', 
        callback: function(key, options) {
            //var m = "clicked: " + key;
            //window.console && console.log(m) || alert(m); 
            if(key == "newfolder")
            	$("#folder").lightbox_me({
                    //centered: true, 
                    onLoad: function() { 
                        $('#folder').find('input:first').focus()
                        }
                    });
           // e.preventDefault();
        },
        items: {
            "edit": {name: "Open", icon: "open"},//edit
            "cut": {name: "Cut", icon: "cut"},
            "copy": {name: "Copy", icon: "copy"},
            "paste": {name: "Paste", icon: "paste"},
            "delete": {name: "Delete", icon: "delete"},
           // "newfolder": {name: "New Folder", icon: "newfolder"},
            "sep1": "---------",
            "quit": {name: "Quit", icon: "quit"}
        }
    });
    
    //$('.container').on('click', function(e){
    //    console.log('clicked', this);
    //})
});
</script>
    <?php }?>
	<div class="clear"></div>

	<!-- <div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div> --><!-- footer -->
	
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?php if(isset(Yii::app()->user->email)) { ?>
<div id="dropbox">
		<div class="text">
			Drop Your Files Here ...
		</div>
	</div>
<?php }?>
</div><!-- page -->

</body>
</html>
