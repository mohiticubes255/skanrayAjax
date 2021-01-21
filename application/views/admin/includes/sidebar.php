  <!-- BEGIN: Left Aside -->
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
  <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

      <!-- BEGIN: Aside Menu -->
      <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
          <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
              <li class="m-menu__item m-menu__item--active" aria-haspopup="true"><a href="#" class="m-menu__link ">
                      <i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title">
                          <span class="m-menu__link-wrap">
                              <span class="m-menu__link-text">Dashboard</span>
                          </span>
                      </span>
                  </a>
              </li>
              <li class="m-menu__section ">
                  <h4 class="m-menu__section-text">Components</h4>
                  <i class="m-menu__section-icon flaticon-more-v2"></i>
              </li>
              
              <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-tags"></i><span class="m-menu__link-text">Catalog</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="m-menu__submenu " m-hidden-height="160" style="display: none; overflow: hidden;"><span class="m-menu__arrow"></span>
                      <ul class="m-menu__subnav">
                          <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url('web/catalog/categories')?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Categories</span></a></li>
                          <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url('web/catalog/products')?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Products</span></a></li>
                          <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url('web/catalog/specialities')?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Specialities</span></a></li>
                      </ul>
                  </div>
              </li>


           



              <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-shopping-cart"></i><span class="m-menu__link-text">Sales</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="m-menu__submenu " m-hidden-height="160" style="display: none; overflow: hidden;"><span class="m-menu__arrow"></span>
                      <ul class="m-menu__subnav">
                          <li class="m-menu__item" aria-haspopup="true"><a href="<?php echo base_url('web/sales/orders')?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Orders</span></a></li>
                          <li class="m-menu__item" aria-haspopup="true"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Returns</span></a></li>
                      </ul>
                  </div>
              </li>



              <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-share-alt"></i><span class="m-menu__link-text">Marketing</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="m-menu__submenu " m-hidden-height="160" style="display: none; overflow: hidden;"><span class="m-menu__arrow"></span>
                      <ul class="m-menu__subnav">
                          <li class="m-menu__item" aria-haspopup="true"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Coupons</span></a></li>
                          <li class="m-menu__item" aria-haspopup="true"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Emails</span></a></li>
                      </ul>
                  </div>
              </li>

              <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fa fa-cog"></i><span class="m-menu__link-text">System</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="m-menu__submenu " m-hidden-height="160" style="display: none; overflow: hidden;"><span class="m-menu__arrow"></span>
                      <ul class="m-menu__subnav">
                          <li class="m-menu__item" aria-haspopup="true"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Settings</span></a></li>
                          <li class="m-menu__item" aria-haspopup="true"><a href="#" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Maintenance</span></a></li>
                      </ul>
                  </div>
              </li>

              <li class="m-menu__item <?php echo (current_url() == base_url('admin/attendance') ? ' m-menu__item--active' : '') ?>" aria-haspopup="true"><a href="#" class="m-menu__link ">
                      <i class="m-menu__link-icon flaticon-list-2"></i><span class="m-menu__link-title">
                          <span class="m-menu__link-wrap">
                              <span class="m-menu__link-text">Reports</span>
                          </span>
                      </span>
                  </a>
              </li>


              <li class="m-menu__item" aria-haspopup="true"><a href="#" class="m-menu__link ">
                      <i class="m-menu__link-icon flaticon-logout"></i><span class="m-menu__link-title">
                          <span class="m-menu__link-wrap">
                              <span class="m-menu__link-text">Logout</span>
                          </span>
                      </span>
                  </a>
              </li>


          </ul>
      </div>

      <!-- END: Aside Menu -->
  </div>