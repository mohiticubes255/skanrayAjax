<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="<?php echo base_url('admin/students') ?>" class="m-brand__logo-wrapper">
                            <img alt="" src="<?php echo base_url('assets/img/logo.png') ?>" width="60px"/>
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>

                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>


                <!-- END: Horizontal Menu -->

                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <?php if ($this->session->userdata('unread_notifications') > 0) { ?>
                                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                    <?php } ?>
                                    <span class="m-nav__link-icon"><i class="flaticon-alarm"></i></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(<?php echo base_url('assets/app/media/img/misc/quick_actions_bg.jpg') ?>); background-size: cover;">
                                            <span class="m-dropdown__header-title">Notifications</span>
                                            <span class="m-dropdown__header-subtitle"><?php echo $this->session->userdata('unread_notifications'); ?> Unread Notification</span>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                                    <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
                                                        <div class="m-list-timeline m-list-timeline--skin-light">
                                                            <div class="m-list-timeline__items">
                                                                <?php //foreach ($this->session->userdata('notifications') as $notification) { ?>
                                                                    <!-- <div class="m-list-timeline__item">
                                                                        <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                        <a href="javascript:void(0)" onclick="markAsSeen('<?php echo $notification->id; ?>','<?php echo $notification->link; ?>')" class="m-list-timeline__text <?php echo ($notification->seen == 'n' ? 'strong' : ''); ?>"><?php echo $notification->heading; ?></a>
                                                                        <span class="m-list-timeline__time"><?php //echo date('d-m-y', strtotime($notification->created_at)) ?></span>
                                                                    </div> -->
                                                                <?php //} ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic">
                                        <img src="<?php echo base_url('assets/img/admin.png'); ?>" class="m--img-rounded m--marginless" alt="" />
                                    </span>
                                    <span class="m-topbar__username m--hide"><?php echo $this->session->userdata('display_name'); ?></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(<?php echo base_url('assets/app/media/img/misc/user_profile_bg.jpg') ?>); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="<?php echo base_url('assets/img/admin.png') ?>" class="m--img-rounded m--marginless" alt="" />

                                                    <!--<span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>-->
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500"><?php echo $this->session->userdata('display_name'); ?></span>
                                                    <a href="javascript:void(0)" class="m-card-user__email m--font-weight-300 m-link"><?php echo $this->session->userdata('email'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">Section</span>
                                                    </li>

                                                    <li class="m-nav__item">
                                                        <a href="<?php echo base_url('admin/profile') ?>" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-user"></i>
                                                            <span class="m-nav__link-text">Profile</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="<?php echo base_url('admin/logout') ?>" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>
<script>
    function markAsSeen(id, link) {
        let data = {
            url: '<?php echo base_url('admin/dashboard/seen_notification') ?>',
            params: `action=mark_as_seen&notification_id=${id}`,
        };
        postRequest(data, false, function(mData, mStatus) {
            window.location.assign(link);
        });
    }
</script>