<div class='user-login'>
<?php if($user->login()):?>
    <div class="user-btn" >
        <a class="user-menu-toggle" href="javascript:;"><?=$user->avatar();?></a>&nbsp;
        <a class="user-menu-toggle" href="javascript:;"><?=$user->nicename()?></a>
        <?php if($user->isRole('vip')): ?>
        <span class="badge badge-custom">vip</span>
        <?php elseif($user->isRole('svip')): ?>
        <span class="badge badge-custom">svip</span>
        <?php endif; ?>
    </div>
    <div class="user-menu">
        <?php if($p = $page->first('user')): ?>
            <a href="<?=$p->url()?>"><?=_t('Personal Center')?></a>
        <?php else: ?>
            <a ><?=$user->nicename()?></a>
        <?php endif; ?>
        <?php //if(is_super_admin($user->id())):?>
            <a href="<?=$user->adminUrl()?>"><?=_t('Admin')?></a>
        <?php //endif; ?>
        <a href="<?=$user->logoutUrl()?>"><?=_t('Logout')?></a>
    </div>
<?php
$template->js .= <<<js
jQuery(function($){
    var userMenuTime;
    $('.user-menu-toggle').on('click',function(){
        $('.user-menu').toggle();
        clearInterval(userMenuTime);
        userMenuTime = setTimeout(function () {
            $('.user-menu').fadeOut(500)
        }, 2000);
    });
});
js
?>
<?php else: ?>
    <div class="user-btn" >
        <a href="javascript:;" data-toggle="modal" data-target="#login-modal"><?=_t('Login')?></a>
    </div>
<?php endif; ?>
</div>
